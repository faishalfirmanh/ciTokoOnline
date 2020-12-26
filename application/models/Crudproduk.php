<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Crudproduk extends CI_Model {


   public function __construct()
    {
        parent::__construct();
    }

      public function addProd($data)
      {
        $this->db->insert('produk1',$data);
      }

      public function addKeranjang($object)
      {
    		$this->db->insert('keranjang1',$object);
      }

      public function selectProduk($id){
        $this->db->get_where('produk1',$id);
      }

}
