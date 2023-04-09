<?php

use ay4t\WhatsAppHelper\WhatsAppSG;
class ForgotPassword extends CI_Controller
{


    public function index()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Forgot Password With Email";
            $this->load->view('templates/header', $data);
            $this->load->view('forgotpassword/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->_verification();
        }
    }
    public function phone()
    {

        $this->form_validation->set_rules('phone', 'phone', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Forgot Password With Phone Number";
            $this->load->view('templates/header', $data);
            $this->load->view('forgotpassword/phone', $data);
            $this->load->view('templates/footer');
        } else {
            $this->_verification();
        }
    }

    private function _verification()
    {
        $this->db->db_debug = false;
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');

        if($email != NULL){
            $tbl_user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();
        } elseif($phone != NULL) {
            $tbl_user = $this->db->get_where('tbl_user', ['phone' => $phone])->row_array();
        }

        if ($email == $tbl_user['email'] | $phone == $tbl_user['phone']) {
            $token = uniqid($tbl_user['nik'], true);
            $insert_token = [
                'email' => $tbl_user['email'],
                'phone' => $tbl_user['phone'],
                'token' => $token,
                'expiration' => time() + 300
            ];
            if (!$this->db->insert('tbl_token', $insert_token)) {
                $this->session->set_flashdata('message', "<div style='color:red;'>Sebelumnya Token Sudah Dikirim</div>");
                header('Location: ' . base_url() . 'forgotpassword/token');
            } else {
                if($email != NULL){
                    $this->load->config('email');
                    $this->load->library('email');
    
                    $from = $this->config->item('smtp_user');
                    $to = $email;
                    $subject = 'Forgot Password Token';
                    $message = 'Berikut ini adalah token anda ' . $token;
    
                    $this->email->set_newline("\r\n");
                    $this->email->from($from);
                    $this->email->to($to);
                    $this->email->subject($subject);
                    $this->email->message($message);
    
    
                    if ($this->email->send()) {
                        $this->session->set_flashdata('message', "<div style='color:green;'>Token Telah Dikirim Melalui Email Anda, Token ini hanya dapat digunakan selama 5 menit</div>");
                        header('Location: ' . base_url() . 'forgotpassword/token');
                    } else {
                        $this->session->set_flashdata('message', "<div style='color:red;'>Token Gagal Dikirim</div>");
                        header('Location: ' . base_url() . 'forgotpassword');
                    }
           
                } elseif($phone != NULL){
                    $message = 'Berikut ini adalah token anda ' . $token;
                    $wa = new WhatsAppSG();
                    $wa->setBaseUrl('http://127.0.0.1')
                        ->setPort('8080')
                        ->setSenderPhone('nomor pengirim')
                        ->setRecepient($phone)
                        ->setMessage($message);
                    $wa->SendText();
                    $this->session->set_flashdata('message', "<div style='color:green;'>Token Telah Dikirim Melalui Nomor Anda, Token ini hanya dapat digunakan selama 5 menit</div>");
                    header('Location: ' . base_url() . 'forgotpassword/token');
                }
               
            }
        } else {
            $this->session->set_flashdata('message', "<div style='color:red;'>Email Anda Tidak Terdaftar</div>");
            header('Location: ' . base_url() . 'forgotpassword');
        }
    }

    public function token()
    {
        $this->form_validation->set_rules('token', 'Token', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Forgot Password";
            $this->load->view('templates/header', $data);
            $this->load->view('forgotpassword/token', $data);
            $this->load->view('templates/footer');
        } else {
            $this->_token();
        }
    }

    private function _token()
    {
        $token = $this->input->post('token');

        $tbl_token = $this->db->get_where('tbl_token', ['token' => $token])->row_array();

        if ($tbl_token['token'] == $token) {

            $this->session->set_flashdata('message', "<div style='color:green;'>Silahkan Buat Password Baru</div>");
            header('Location: ' . base_url() . 'forgotpassword/resetpassword/' . $token);
        } else {
            $this->session->set_flashdata('message', "<div style='color:red;'>Token Salah</div>");
            header('Location: ' . base_url() . 'forgotpassword/token');
        }
    }

    public function resetpassword($token)
    {
        $this->load->model('M_Welcome');
        $data['title'] = "Forgot Password";
        $data['token'] = $token;
        $data['queryDataUser'] = $this->M_Welcome->getDataById('tbl_token', 'token', $token);
        $this->load->view('templates/header', $data);
        $this->load->view('forgotpassword/resetpassword', $data);
        $this->load->view('templates/footer');
    }
    public function resetpasswordaksi()
    {
        $this->load->model('M_Welcome');

        $password = $this->input->post('password');
        $verify_password = $this->input->post('verify_password');
        $email = $this->input->post('email');
        $token = $this->input->post('token');

        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('verify_password', 'Verify Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', "<div style='color:red;'>Pastikan Semua Form Diisi</div>");
            header('Location: ' . base_url() . 'forgotpassword/resetpassword/' . $token);
        } else {
            if ($password == $verify_password) {

                $resetpassword = $this->M_Welcome->getDataById('tbl_user', 'email', $email);
                if (count($resetpassword) > 0) {
                    foreach ($resetpassword as $row)
                        $update = [
                            'password' => $password,
                        ];
                    $where = [
                        'email' => $row->email,
                    ];
                }
                $this->db->update('tbl_user', $update, $where);
                $this->M_Welcome->delete_data($where, 'tbl_token');
                $this->session->set_flashdata('message', "<div style='color:green;'>Password Anda Telah Dibuat Ulang, Silahkan Login</div>");
                header('Location: ' . base_url() . 'auth');
            } else {
                $this->session->set_flashdata('message', "<div style='color:red;'>Harap Samakan Password Anda</div>");
                header('Location: ' . base_url() . 'forgotpassword/resetpassword/' . $token);
            }
        }
    }
}
