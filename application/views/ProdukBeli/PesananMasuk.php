
<title>Pesanan </title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<body>
  <?php $idUsr = $_SESSION['id']; ?>
  <?php $sql = "SELECT idOr,namaUser,nama,jumlah,alamat,buktiTransver,status FROM `keranjang1`
                JOIN produk1 on keranjang1.idProd = produk1.id
                JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
                JOIN order1 on keranjang1.id = order1.idKeranjang WHERE buktiTransver is NOT null AND idPengguna = '$idUsr'";
      $query = $this->db->query($sql);?>
<style media="screen">
.bung{
  margin-left: 70px;
  margin-top: 80px;
}
</style>
<div class="bung">
  <h2>Pesanan Masuk</h2>
  <table id="" class="table table-bordered" style="width:70%;">
    <thead>
      <tr>
        <th>idOr</th>
        <th>nama pembeli</th>
        <th>nama produk</th>
        <th>jumlah</th>
        <th>alamat</th>
        <th>foto transver</th>
        <th>status</th>
        <td>Edit</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($query->result() as $order) {?>
    <tr>
          <td><?php echo $order->idOr; ?></td>
        <td><?php echo $order->namaUser; ?></td>
        <td><?php echo $order->nama; ?></td>
        <td><?php echo "$order->jumlah"; ?></td>
          <td><?php echo $order->alamat; ?></td>
        <td>   <img  src="<?php echo base_url('upload/').$order->buktiTransver;?>" width="120" height="180"><br></td>
        <td><?php echo $order->status; ?></td>
        <td>
          <?php
          $status = $order->status;
          $idnya = $order->idOr;
          $sitee =  site_url('PesananCont/editPesanan/').$idnya;
          if ($status === 'pesanan_sudah_sampe_pelanggan') {
            echo "untung";
          }else {
            echo " <a href='$sitee' class='btn btn-info'>Edit</a>";
          }
          ?>

        </td>
    </tr>
    <?php    } ?>
    </tbody>
  </table>

  <a href="<?php echo site_url('');?>/PesananCont/viewGrafik"  class="btn btn-primary">Cek Laba</a>
</div>
</body>
