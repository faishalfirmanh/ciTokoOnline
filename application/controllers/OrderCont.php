<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderCont extends CI_Controller {

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
	//	print_r($data);
	}

	public function btnDetailProduk($idNya){
		$this->fungsiSesesion();
		$this->load->view('Produk2/NavUser');
		$this->load->view('ProdukBeli/DetailProd',$idNya);
	}

	public function uploadGmbr(){
			$tgl = date("Y_m_d H:i:s");
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'jpg|png|gif|jpeg';
		$config['max_size']  = '100000';
		$config['max_width']  = '10240';
		$config['max_height']  = '7680';
		$config ['image_width']   = '120';
    $config['image_height']  = '120';
		//$config['file_name'] = $tgl;
		$this->load->library('upload', $config);

	}
	public function orderBarang(){
		$this->load->model('Crudproduk');
		$idPel = $this->input->post('idPeng');
		$idProd = $this->input->post('idProd');
		$jumlah = $this->input->post('totalBeli');
		$this->uploadGmbr();
		if ( ! $this->upload->do_upload('userfile')) { //empty($_FILES['userfile']['name']) = php manual
		//	echo "kosong gambarnya";
			$object = array
			(
				'idPel' =>$idPel,
				'idProd'=>$idProd,
				'jumlah' =>$jumlah
			);
			$this->Crudproduk->addKeranjang($object);
			redirect('OrderCont/suksesPesan','refresh');
		}else {
			$gambar = $this->upload->data();
			$gambar = $gambar['file_name'];


		  $prod2 = $this->db->get_where('produk1', array('id' => $idProd));
			foreach ($prod2->result() as $prodSel)
			{
				$stokProdOld = $prodSel->stok;
				$hasilFix = $stokProdOld-$jumlah;
				if ($hasilFix> 0) //cek stok
				{
					$object = array
					(
						'idPel' =>$idPel,
						'idProd'=>$idProd,
						'jumlah' =>$jumlah,
						'buktiTransver'=>$gambar
					);
					$this->Crudproduk->addKeranjang($object);
					redirect('OrderCont/suksesOrder','refresh');
				}else
				{
					redirect('OrderCont/gagalPesan','refresh');
				}
			}
			}
		}

		public function suksesPesan(){
			$this->fungsiSesesion();
			$this->load->view('Produk2/NavUser');
			$this->load->view('Kondisi/SuksesKeranjang');
		}
		public function suksesOrder(){
			$this->fungsiSesesion();
			$this->load->view('Produk2/NavUser');
			$this->load->view('Kondisi/suksesPesan');
		}
		public function gagalPesan(){
			$this->fungsiSesesion();
			$this->load->view('Produk2/NavUser');
			$this->load->view('Kondisi/MaafGagalOrder');
		}



}
