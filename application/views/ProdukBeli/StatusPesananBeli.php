
<title>Status Pesanan Beli</title>
<body>
  <?php $idUsr = $_SESSION['id'];
  $idOr = $this->uri->segment(3);
   ?>
  <?php $sql = "SELECT idOr,nama,alamat,buktiTransver,status
              FROM `keranjang1`
              JOIN produk1 on keranjang1.idProd = produk1.id
              JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
              JOIN order1 on keranjang1.id = order1.idKeranjang WHERE idPel = '$idUsr'";
      $query = $this->db->query($sql);?>
<style media="screen">
.bung{
  margin-left: 70px;
  margin-top: 80px;
}
</style>
<div class="bung">
  <h2 style="background-color:rgb(119,219,82); width:70%;">Status Pesanan Yang Anda Beli</h2>
  <table class="table table-bordered" style="width:70%;">
    <thead>
      <tr>
        <th>nama Produk</th>
        <th>alamat</th>
        <th>buktiTransver</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($query->result() as $order) {?>
    <tr>
      
        <td><?php echo $order->nama; ?></td>
        <td><?php echo $order->alamat; ?></td>
        <td>   <img  src="<?php echo base_url('upload/').$order->buktiTransver;?>" width="120" height="180"><br></td>
        <td>
          <?php
          $kondisi = $order->status;
          if ($kondisi ==='ditrima') {
            echo "<div style='background-color:red;text-align: center; width:120px;height:35px;'>"."<b style='color:white;'>".$kondisi."</b>"."</div>";
          }elseif ($kondisi ==='sudah_dikirim') {
            echo "<div style='background-color:rgb(186,224,27);text-align: center; width:120px;height:35px;'>"."<b style='color:white;'>".$kondisi."</b>"."</div>";
            echo "<br> <label></label>";
            $mek =  site_url('PesananCont/EditStatusPelanggan/').$order->idOr;
            echo "<br>  <a href='$mek' class='btn btn-info'>Konfirmasi Ditrima</a>";
          }else{
            echo "<div style='background-color:rgb(48,118,210);text-align: center; width:120px;height:35px;'>"."<b style='color:white;'>Order Sukses</b>"."</div>";
          }
         ?>
        </td>


    </tr>
    <?php    } ?>
    </tbody>
  </table>
</div>
</body>
