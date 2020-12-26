<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Laba</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  </head>
  <body>
    <?php $idUsr = $_SESSION['id']; ?>
    <?php $sql = "SELECT nama,SUM(jumlah) AS 'totalTerjual' FROM `keranjang1`
                JOIN produk1 on keranjang1.idProd = produk1.id
                JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
                JOIN order1 on keranjang1.id = order1.idKeranjang
                WHERE idPengguna = '$idUsr' AND keberhasilanJual ='untung'
                GROUP BY nama" ;
          $totalBaris = "SELECT count(*) AS 'totalBaris' FROM `keranjang1`
                      JOIN produk1 on keranjang1.idProd = produk1.id
                      JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
                      JOIN order1 on keranjang1.id = order1.idKeranjang
                      WHERE idPengguna = '$idUsr' AND keberhasilanJual ='untung'";
                $query = $this->db->query($sql);
                $query2 =$this->db->query($totalBaris);
                ?>

                <table class="table table-bordered" style="width:70%;">
                  <thead>
                    <tr>
                      <th>nama produk</th>
                      <th>jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($query->result() as $order) {?>
                  <tr>
                    <td>
                      <?php
                        $namProd = $order->nama;
                      echo "$namProd";                      ?>
                    </td>
                      <td><?php echo $order->totalTerjual; ?></td>
                  </tr>
                  <?php    } ?>
                  </tbody>
                </table>

  </body>
</html>
