<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PenggunaModel extends CI_Model {

  public function __construct()
   {
       parent::__construct();
   }


   public function insertPengguna($data){
     $this->db->insert('pengguna1',$data);
   }

   public function cekLogin($tabel,$id){
     return $this->db->get_where($tabel,$id);
   }
   public function getId($id){
    $this->db->get_where('pengguna1', $id);
   }

}
 ?>
