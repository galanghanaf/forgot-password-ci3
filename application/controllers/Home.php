<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	private $login;
	
	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('nik') == NULL){
			header('Location: ' . base_url() . 'auth/logout');
		}

		$this->login = $this->db->get_where(
			'tbl_user',
			['nik' => $this->session->userdata('nik')]
		)->row_array();
		
	}
	
	public function index()
	{
		$this->load->model('M_Welcome');

		$data['login'] = $this->login;
		$data['title'] = "Welcome";
		$data['getDataUser'] = $this->M_Welcome->getAllData('tbl_user', 'nama', 'ASC');

		$this->load->view('templates/header', $data);
		$this->load->view('home/index', $data);
		$this->load->view('templates/footer');
	}


}
