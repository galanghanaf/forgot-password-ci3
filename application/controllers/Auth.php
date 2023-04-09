<?php 
class Auth extends CI_Controller{

    public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == false){
            $data['title'] = "Login";
            $this->load->view('templates/header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->_login();
        }
		
	}

    private function _login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $login = $this->db->get_where('tbl_user', ['email' => $email])->row_array();

        if ($login) {
            if($password == $login['password']){
                $data['nik'] = $login['nik'];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('message', "<div style='color:green;'>Anda Berhasil Login</div>");
                header('Location: '. base_url() . 'home');
            } else {
                $this->session->set_flashdata('message', "<div style='color:red;'>Password Anda Salah</div>");
                header('Location: ' . base_url() . 'auth');
            }
        } else {
            $this->session->set_flashdata('message', "<div style='color:red;'>Email Anda Tidak Terdaftar</div>");
            header('Location: ' . base_url() . 'auth');
        }
    }

   

    public function logout(){
        $this->session->unset_userdata('nik');
        $this->session->set_flashdata('message', "<div style='color:green'>Berhasil Logout</div>");
        header('Location: ' . base_url() . 'auth');
    }
}
