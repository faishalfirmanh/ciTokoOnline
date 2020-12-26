<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>grapik</title>

  </head>
  <body>
    <?php
      // $idUsr = $_SESSION['id'];
      // $sql = "SELECT nama,SUM(jumlah) AS 'totalTerjual' FROM `keranjang1`
      //             JOIN produk1 on keranjang1.idProd = produk1.id
      //             JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
      //             JOIN order1 on keranjang1.id = order1.idKeranjang
      //             WHERE idPengguna = '$idUsr' AND keberhasilanJual ='untung'
      //             GROUP BY nama" ;
      // $query = $this->db->query($sql);
      // foreach($dataGraf as $data){
      //       $nama[] = $data->nama;
      //       $tot[] = (float) $data->totalTerjual;
      //   }
   ?>
   <!-- <canvas id="canvas" width="1000" height="280"></canvas> -->
   <div class="" style="margin-top:80px;">

   </div>
    <h2>Rangkumang Grafik Hasil Penjualan</h2>
    <div id="graph"></div>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
    Morris.Bar({
       element: 'graph',
       data: <?php echo $data;?>,
       xkey: 'nama',
       ykeys: ['totalTerjual', 'sale'],
       labels: ['terjual', 'totalTerjual']
     });
    </script>
  </body>
</html>
