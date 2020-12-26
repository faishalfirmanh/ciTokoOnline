<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Laba</title>
  </head>
  <style media="screen">
    .tengah{
      display: grid;
      place-content:center;
      gap: 2ch;   1

      /* display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap:2ch; */


    }

  </style>
  <body>
    <?php $idUsr = $_SESSION['id']; ?>
    <?php $sql = "SELECT nama,jumlah AS 'totalTerjual' FROM `keranjang1`
                JOIN produk1 on keranjang1.idProd = produk1.id
                JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
                JOIN order1 on keranjang1.id = order1.idKeranjang
                WHERE idPengguna = '$idUsr' AND keberhasilanJual ='untung'" ;
          $totalBaris = "SELECT count(*) AS 'totalBaris' FROM `keranjang1`
                      JOIN produk1 on keranjang1.idProd = produk1.id
                      JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
                      JOIN order1 on keranjang1.id = order1.idKeranjang
                      WHERE idPengguna = '$idUsr' AND keberhasilanJual ='untung'";
                $query = $this->db->query($sql);
                $query2 =$this->db->query($totalBaris);
                ?>
<?php
$hasil = "SELECT nama,jumlah AS 'totalTerjual' FROM `keranjang1`
            JOIN produk1 on keranjang1.idProd = produk1.id
            JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
            JOIN order1 on keranjang1.id = order1.idKeranjang
            WHERE idPengguna = '$idUsr' AND keberhasilanJual ='untung'";
        $hh = $this->db->query($hasil); ?>
  <?php         if( $hh->num_rows() > 0) {
                $result = $query->result(); //or $query->result_array() to get an array
                $aremptyNam = [];
                $arJumlah = [];
                foreach( $result as $row )
                {
                  $namaBar ="$row->nama";
                  $tot = $row->totalTerjual;
                  $strAr = explode('<br>',$namaBar);
                  $strArJum = explode('<br>',$tot);
                  $finalAr = array_unique($strAr);
                  $fnlStr = implode('<br>',$finalAr);
                //  print_r($strArJum);
                  array_push($aremptyNam,$fnlStr);
                  array_push($arJumlah,$strArJum);

                  echo "$namaBar "."=>"."$tot"."<br>";


                };
                $cariUnik = array_unique($aremptyNam);
                $toStrn = implode('<br>',$cariUnik);
            //    echo "$toStrn";


            } ?>



  </body>
</html>
