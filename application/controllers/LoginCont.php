<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginCont extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Login');

			parent::__construct();
			 $this->load->library('form_validation','session');
			 $this->load->database();
			$this->load->view('LoginView');
	}
	public function LoginView(){
		$this->load->view('LoginView');
	}
	public function ProsesLogin(){
		$this->load->helper('url');

		if ($this->input->post('username')) {
			$usr = $this->input->post('username');
			$pas = $this->input->post('password');
			$user = array(
				'username'=>$usr,
				'password'=>$pas
			);
			$proLog =  $this->db->get_where('employee',array('username'=>$user['username']));
			foreach ($proLog->result() as $pengguna) {
				if ($user['username']== $pengguna->username && $user['password'] == $pengguna->password) {
					$_SESSION['username'] = $user['username'];
					$this->load->view('leanding');
				}else {
				echo "failed lOGIN";
				}
			}
		}else {
				 redirect('LoginCont','refresh');
		}
	}
	public function Logout(){
		session_unset();
		session_destroy();
		redirect('LoginCont','refresh');
	}

}
