
<?php
$idOr = $this->uri->segment(3);
$idUsr = $_SESSION['id'];
$sql = "SELECT idOr,namaUser,nama,jumlah,alamat,buktiTransver,status FROM `keranjang1`
              JOIN produk1 on keranjang1.idProd = produk1.id
              JOIN pengguna1 ON keranjang1.idPel = pengguna1.id
              JOIN order1 on keranjang1.id = order1.idKeranjang WHERE buktiTransver is NOT null AND idPengguna = '$idUsr' AND idOr = '$idOr'";

?>
<title>Edit Pesanan</title>
<body>
  edit
  <?php echo "$idOr"; ?>
  <?php
  $query = $this->db->query($sql);
  foreach ($query->result() as $value) {?>
    <?php echo form_open('PesananCont/updatePesanan/'.$idOr); ?>
      <div class="col-md-6">
          <label>Nama Pemesan</label>
          <input class="form-control" type="text" name="nama" value="<?php echo $value->namaUser;?>" disabled>
      </div>
      <div class="col-md-6">
          <label>Barang</label>
          <input class="form-control" name="barang" type="text" value="<?php echo $value->nama;?>" disabled>
      </div><br>

      <div class="col-md-6">
          <label style="background-color:rgb(99,246,48);">Edit Status jika barang sudah dikirim</label>
            <select class="form-control input-sm" name="status" value="<?php echo $value->status;?>">
              <option value="ditrima">ditrima</option>
              <option value="sudah_dikirim">sudah_dikirim</option>
            </select>
      </div><br>
      <div class="" style="margin-left:20px;">
          <input type="submit" class="btn btn-info" value="simpan">
      </div>
    <?php echo form_close(); ?>
  <?php }?>
</body>
