<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeCont extends CI_Controller {

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
			parent::__construct();
			 $this->load->library('form_validation','session');
			 $this->load->database();
	}

	public function Awal(){
		$this->load->view('Home/Awal');
	}

	public function AllProduck(){
		$this->load->library('session');
		$data['pengguna1'] = $this->db->get_where('pengguna1',['namaUser'=>$this->session->userdata('namaUser')])->row_array();
	//	$_SESSION['created'];
		$this->load->view('Produk2/NavUser');
		$this->load->view('Produk2/ListAllProd');
	}

}
