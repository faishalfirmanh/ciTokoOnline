<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdCont extends CI_Controller {

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

		public function formTambahProd(){
			$this->load->library('session');
			$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
			if ($cekSes) {
				$this->load->view('cssjsview/file');
				$this->load->view('Kondisi/GagalAkses');
			}else {
				$data['pengguna1'] = $this->db->get_where('pengguna1',['namaUser'=>$this->session->userdata('namaUser')])->row_array();
				$this->load->view('Produk2/NavUser');
				$this->load->view('Produk2/HomeProd');
			}

		}
		public function fungsiSesesion(){
			$this->load->library('session');
			$data['pengguna1'] = $this->db->get_where('pengguna1',['namaUser'=>$this->session->userdata('namaUser')])->row_array();
		}

		public function uploadFotoProduk(){
			$config['upload_path'] = './fotoProduk/';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';
			$config['max_size']  = '100000';
			$config['max_width']  = '10240';
			$config['max_height']  = '7680';
			$config ['image_width']   = '120';
			$config['image_height']  = '120';
			//$config['file_name'] = $tgl;
			$this->load->library('upload', $config);
		}

		public function tambahProduk(){
				$this->load->library('session');
			$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
			if ($cekSes) {
				$this->load->view('cssjsview/file');
				$this->load->view('Kondisi/GagalAkses');
			}else {
				$this->uploadFotoProduk();
				$this->load->model('Crudproduk');
				$this->load->model('PenggunaModel');
				$idPeng = $this->input->post('idPeng');
				$nameProd = $this->input->post('nameProd');
				$kat =  $this->input->post('kategori');
				$stok =  $this->input->post('stok');
				$harg =  $this->input->post('harga');
			if ( ! $this->upload->do_upload('fotoProduk'))
				{
					echo "harap upload gambar";
				}
				else {
					$gambar = $this->upload->data();
					$gambar = $gambar['file_name'];
					$prodBaru = array(
						'idPengguna'=>$idPeng,
						'nama'=>$nameProd,
						'foto'=>$gambar,
						'kategori'=>$kat,
						'harga'=>$harg,
						'stok'=>$stok
					);
					$this->Crudproduk->addProd($prodBaru);
					redirect('ProdCont/SuksesAdd');
				}
			}


		}

		public function SuksesAdd(){
			$this->fungsiSesesion();
			$this->load->view('Produk2/NavUser');
			$this->load->view('Kondisi/SuksesAdd');
		}

		public function ListMyProd(){
			$this->load->library('session');
			$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
			if ($cekSes) {
				$this->load->view('cssjsview/file');
				$this->load->view('Kondisi/GagalAkses');
			}else {
				$data['pengguna1'] = $this->db->get_where('pengguna1',['namaUser'=>$this->session->userdata('namaUser')])->row_array();
				// $_SESSION['id'];
				// echo "Haloo user ".$data['pengguna1']['id'];
				$this->load->view('Produk2/NavUser');
				$this->load->view('Produk2/ListProd');
			}


		}
		public function FormEditMyprod($id){
			$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
			if ($cekSes) {
				$this->load->view('cssjsview/file');
				$this->load->view('Kondisi/GagalAkses');
			}else {
				$this->fungsiSesesion();
				$this->load->view('Produk2/NavUser');
				$this->load->view('Produk2/EditProdView',$id);
			}
		}

		public function Delete($id){
			$this->fungsiSesesion();
			$this->load->view('Produk2/NavUser');
			$this->db->delete('produk1', array('id' => $id));
			$this->load->view('Kondisi/SuccesHapus');
		}

		public function Tojson(){
			 $prod = $this->db->get_where('produk1')->result(); //berpa array
			 $convert = json_encode(array("data" => $prod)); //convet to json
			// print_r($prod);
			 // foreach ($prod as $key ) {
			 // 	echo "$key->nama";
			 // }
			 echo "$convert";
		}

}
