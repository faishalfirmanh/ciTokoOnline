<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LabaModel extends CI_Model {

  public function __construct()
   {
       parent::__construct();
   }


  public function labagrafik(){
      $idUsr =4;
      $query = $this->db->query("SELECT nama,SUM(jumlah) AS 'totalTerjual' FROM `keranjang1`
                  JOIN produk1 on keranjang1.idProd = produk1.id
                  JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
                  JOIN order1 on keranjang1.id = order1.idKeranjang
                  WHERE idPengguna = '$idUsr' AND keberhasilanJual ='untung'
                  GROUP BY nama");

       if($query->num_rows() > 0){
           foreach($query->result() as $data){
               $hasil[] = $data;
           }
           return $hasil;
       }

  }

  function get_data_moris($id){
    $idUsr =$id;
    $sql ="SELECT nama,SUM(jumlah) AS 'totalTerjual' FROM `keranjang1`
                JOIN produk1 on keranjang1.idProd = produk1.id
                JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
                JOIN order1 on keranjang1.id = order1.idKeranjang
                WHERE idPengguna = '$idUsr' AND keberhasilanJual ='untung'
                GROUP BY nama";
      $hasil = $this->db->query($sql);
      return $hasil;
 }

}
 ?>
