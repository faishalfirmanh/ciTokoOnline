<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterPenggunaCont extends CI_Controller {

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
			 $this->load->model('PenggunaModel');
			parent::__construct();
			 $this->load->library('form_validation','session');
			 $this->load->database();
	}

	public function FormRegister(){
		$this->load->view('UserReg/RegisterUser');
	}
	public function ProsesRegister(){
		$this->load->model('PenggunaModel');
		date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d h:i:sa');
		$name = $this->input->post('name');
		$addrs =  $this->input->post('address');
		$pass =  $this->input->post('pass');

		$newUser = array(
			'namaUser'=>$name,
			'alamat'=>$addrs,
			'password'=>$pass,
			'created'=>$tgl
		);
		$this->PenggunaModel->insertPengguna($newUser);
		redirect('RegisterPenggunaCont/FormRegister');

	}

	public function login(){
		$this->load->view('UserReg/Login');
	}
	public function prosesLogin(){
		session_start();
		$this->load->model('PenggunaModel');
		if ($this->input->post('username')) {
			$usr = $this->input->post('username');
			$pas = $this->input->post('pass');
			$user = array(
				'id',
				'namaUser'=>$usr,  //yang string merupakan kolom di db
				'password'=>$pas
			);
			// $proLog =  $this->db->get_where('pengguna1',array('nama'=>$user['username']));
			// foreach ($proLog->result() as $pengguna) {
			// 	if ($user['username']== $pengguna->username && $user['password'] == $pengguna->password) {
			// 		$_SESSION['username'] = $user['username'];
			// 		$this->load->view('Produk/HomeProd');
			// 	}else {
			// 	echo "failed lOGIN";
			// 	}
			// }
			$cek = $this->PenggunaModel->cekLogin('pengguna1',$user)->num_rows(); //num_rows menghitung jumlh baris di table
			if ($cek > 0) {

				$sel = $this->PenggunaModel->cekLogin('pengguna1',$user);
				$query = $this->db->get_where('pengguna1',$user); //menselect id yg sudah login
				foreach ($query->result() as $row) //memilih isi colom pada table
				{
					$idUser = $_SESSION['id'];
					$_SESSION['namaUser'] = $user['namaUser'];
				  $idUserlogin =  $row->id;
					$_SESSION['id'] = $idUserlogin;

					$this->load->view('Produk/NavUser');
					$this->load->view('Produk/ListProd');
				}
			}else {
				 redirect('RegisterPenggunaCont/login','refresh');
					//echo "hancok";
			}
		}else {
				 redirect('RegisterPenggunaCont/login','refresh');
		}
	}

		public function fungsiSesesion(){
			$this->load->library('session');
			$data['pengguna1'] = $this->db->get_where('pengguna1',['namaUser'=>$this->session->userdata('namaUser')])->row_array();
		}
		public function logOut(){
				$this->load->library('session');
			$this->session->unset_userdata('namaUser');
			$this->session->sess_destroy();
			redirect('RegisterPenggunaCont/login','refresh');
		}


		public function formGagal(){
			$this->load->view('Kondisi/GagalLogin');
		}

		public function LoginDua(){
			$this->load->library('session');
			$this->load->model('PenggunaModel');
			$usr = $this->input->post('username');
			$pas = $this->input->post('pass');
			$userData = $this->db->get_where('pengguna1',['namaUser'=>$usr],['pass'=>$pas])->row_array(); //1
			//var_dump($userData);
			//die;

			$user = array(
				'id',
				'namaUser'=>$usr,  //yang string merupakan kolom di db
				'password'=>$pas
			);
			$cek = $this->PenggunaModel->cekLogin('pengguna1',$user)->num_rows(); //2
			if ($cek) { //saat betul
				//	if ($userData['created'] == '2020-12-12') { //user kadal dan cok
						// echo "dua belas belas";
						// if (password_verify($pas,$userData['password'])) {
							$datanya = [
								'id'=>$userData['id'],
								'namaUser'=>$userData['namaUser'],
								'created'=>$userData['created']
							];
						$this->session->set_userdata($datanya);
						//	redirect('ProdCont/ListMyProd');
						$this->load->view('Produk2/NavUser');
						$this->load->view('Produk2/ListProd');
						// }else {
						// 	echo "gagal masuk bos";
						// }
			//		}else {
				//		echo "tidak dua belas belas";
				//	}
			}else {
			//	$this->session->set_flashdata('message','<h5>maaf pengguna tidak ada </h5>');
				redirect('RegisterPenggunaCont/salah');

			}
		}

		public function salah(){
				$this->load->view('UserReg/Login');
				$this->formGagal();
		}


}
