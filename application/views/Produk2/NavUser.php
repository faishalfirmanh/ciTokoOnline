<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <?php $this->load->view('cssjsview/file') ?>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
          <a class="nav-link" href="<?php echo site_url('HomeCont/AllProduck')?>">Produk Beli</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('ProdCont/ListMyProd')?>">My Produk</a>
      </li>
      <li class="nav-item">
        <span class="nav-link">Selamat datang <b style="color:red;">
          <?php
          $sesNama = $_SESSION['namaUser'];
          // $cekSes =!isset($_SESSION) || !isset($_SESSION['namaUser']) || !isset($_SESSION['id']); //defatultnya tidak ada
          // if ($cekSes) {
          //   $this->load->view('Kondisi/GagalAkses');
          // }else {
            // echo "betul cok";
            echo "$sesNama";
        //  }
          ?>
        </b></span>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('ProdCont/formTambahProd')?>">Add new Produk</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('PesananCont/statusPesanan')?>"><b style="color:red">Pesanan Masuk</b></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('PesananCont/StatusPesananPembeli')?>"><b style="color:rgb(73,173,26)">barang beli</b></a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link" href="<?php echo site_url('RegisterPenggunaCont/logOut')?>">Logout</a>
      </li>
    </ul>
    </div>
    </nav>
  </body>
</html>
