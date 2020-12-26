<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PesananCont extends CI_Controller {

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
	public function fungsiSesesion(){
		$this->load->library('session');
		$data['pengguna1'] = $this->db->get_where('pengguna1',['namaUser'=>$this->session->userdata('namaUser')])->row_array();
	}

	public function statusPesanan(){
			$this->load->library('session');
		$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
		if ($cekSes) {
			$this->load->view('cssjsview/file');
			$this->load->view('Kondisi/GagalAkses');
		}else{
			$this->fungsiSesesion();
			$this->load->view('Produk2/NavUser');
			$this->load->view('ProdukBeli/PesananMasuk');
			//namaUser,nama,jumlah,alamat FROM `keranjang1` JOIN produk1 on keranjang1.idProd = produk1.id JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
		}
	}

	public function editPesanan($id){
			$this->load->library('session');
		$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
		if ($cekSes) {
			$this->load->view('cssjsview/file');
			$this->load->view('Kondisi/GagalAkses');
		}else{
		$this->fungsiSesesion();
		$this->load->view('Produk2/NavUser');
		$this->load->view('ProdukBeli/EditPesanan',$id);
	}
	}

	public function updatePesanan($id){
				$this->load->library('session');
		$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
		if ($cekSes) {
			$this->load->view('cssjsview/file');
			$this->load->view('Kondisi/GagalAkses');
		}else {
		date_default_timezone_set('Asia/Jakarta');
		$tgl = date("Y-m-d h:i:sa");
		$status = $this->input->post('status');
				$Order = array(
					'status'=>$status,
					'dikirimDate'=>$tgl
				);
			$this->db->where('idOr',$id);
			$this->db->update('order1',$Order);
			redirect('PesananCont/SuksesEdit','refresh');
		}
	}

	public function SuksesEdit(){
			$this->fungsiSesesion();
			$this->load->view('Produk2/NavUser');
			$this->load->view('Kondisi/SuksesEditPesanan');
	}

	public function StatusPesananPembeli(){
			$this->load->library('session');
		$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
		if ($cekSes) {
			$this->load->view('cssjsview/file');
			$this->load->view('Kondisi/GagalAkses');
		}else{
			$this->fungsiSesesion();
			$this->load->view('Produk2/NavUser');
			$this->load->view('ProdukBeli/StatusPesananBeli');
		}
	}

	public function EditStatusPelanggan($id){
		$this->fungsiSesesion();
		$this->load->view('Produk2/NavUser');
		$this->load->view('ProdukBeli/EditOrderSuc',$id);
	}

	public function updateBarangDitrima($id){
		$this->load->library('session');
		$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
		if ($cekSes) {
			$this->load->view('cssjsview/file');
			$this->load->view('Kondisi/GagalAkses');
		}else{
			date_default_timezone_set('Asia/Jakarta');
			$tgl = date("Y-m-d h:i:sa");
			$status = $this->input->post('status');
					$Order = array(
						'status'=>$status
					);
				$this->db->where('idOr',$id);
				$this->db->update('order1',$Order);
				redirect('PesananCont/SuksesEdit','refresh');
		}
	}
	public function grafikmodel(){
		$idUsr =4;
		$sql = "SELECT nama,SUM(jumlah) AS 'totalTerjual' FROM `keranjang1`
								JOIN produk1 on keranjang1.idProd = produk1.id
								JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
								JOIN order1 on keranjang1.id = order1.idKeranjang
								WHERE idPengguna = '$idUsr' AND keberhasilanJual ='untung'
								GROUP BY nama" ;
			$query = $this->db->query($sql);
			return $query->result();
			// $dataArr = $query->result();
		  // $convert = json_encode(array("data" => $dataArr));
			// echo "$convert";
	}

	public function viewGrafik(){
			$this->load->library('session');
		$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
		if ($cekSes) {
			$this->load->view('cssjsview/file');
			$this->load->view('Kondisi/GagalAkses');
		}else {
			$this->fungsiSesesion();
			$this->load->view('Produk2/NavUser');
			$idUsr = $_SESSION['id'];
			$this->load->model('Labamodel');
			$data = $this->Labamodel->get_data_moris($idUsr)->result();
			 $x['data'] = json_encode($data);
			 $this->load->view('Grap2',$x);
		}
	}
	public function Laba(){
		$cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
		if ($cekSes) {
			$this->load->view('cssjsview/file');
			$this->load->view('Kondisi/GagalAkses');
		}else{
			$this->fungsiSesesion();
			$this->load->view('Produk2/NavUser');
			$this->load->view('ProdukBeli/Laba1');
		}
	}



}
