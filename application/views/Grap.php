<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>grapik</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  </head>
  <body>
    <?php
      $idUsr = $_SESSION['id'];
      $sql = "SELECT nama,SUM(jumlah) AS 'totalTerjual' FROM `keranjang1`
                  JOIN produk1 on keranjang1.idProd = produk1.id
                  JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
                  JOIN order1 on keranjang1.id = order1.idKeranjang
                  WHERE idPengguna = '$idUsr' AND keberhasilanJual ='untung'
                  GROUP BY nama" ;
      $query = $this->db->query($sql);
      foreach($query->result() as $data){
            $nama[] = $data->nama;
            $tot[] = (float) $data->totalTerjual;
        }
   ?>
   <canvas id="canvas" width="1000" height="280"></canvas>

    <script type="text/javascript">
    var lineChartData = {
               labels : <?php echo json_encode($nama);?>,
               datasets : [

                   {
                       fillColor: "rgba(60,141,188,0.9)",
                       strokeColor: "rgba(60,141,188,0.8)",
                       pointColor: "#3b8bba",
                       pointStrokeColor: "#fff",
                       pointHighlightFill: "#fff",
                       pointHighlightStroke: "rgba(152,235,239,1)",
                       data : <?php echo json_encode($tot);?>
                   }

               ]

           }

       var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);

    </script>
  </body>
</html>
