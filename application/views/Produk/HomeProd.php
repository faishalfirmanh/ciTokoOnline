<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CRUD Produk</title>
      <?php $this->load->view('cssjsview/file') ?>
      <link rel="stylesheet" href="<?php echo base_url("/templete/Kustom.css");?>">
  </head>
  <body>
    <?php
    $cekSes =!isset($_SESSION) || !isset($_SESSION['nama']) || !isset($_SESSION['id']); //defatultnya tidak ada
    if ($cekSes) {
    //  echo "salah";
    }else {
      // echo "betul cok";
      $pek = "Selamat Datang "."<b>".$_SESSION['nama']; $id =$_SESSION['id'];
    }
    ?>

    <div class="posForm widthInput">
        <?php echo form_open('ProdCont/tambahProduk'); ?>
        <h1>Tambah Produk</h1>
      <?php
      if ($cekSes==false) {
        // $id =$_SESSION['id'];
        echo '<input type="hidden"  name="idPeng" value='.$id.' class="form-control" aria-describedby="emailHelp">';
      }?>
      <div class="form-group">
        <label for="name"> name produk</label>
        <input type="text" name="nameProd" placeholder="input name" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="phone">Kategori</label>
        <input type="text" name="kategori" placeholder="input kategori" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="phone">Stok</label>
        <input type="number" name="stok" placeholder="input jumlah barang" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="phone">Harga Satuan</label>
        <input type="number" name="harga" placeholder="input harga" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      <input type="submit" name="addEmploye" class="btn btn-primary" value="Save">
      <?php echo form_close(); ?>
    </div>
  </body>
</html>
