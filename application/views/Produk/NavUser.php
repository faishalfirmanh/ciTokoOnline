<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <?php $this->load->view('cssjsview/file') ?>
      <?php

      $cekSes =!isset($_SESSION) || !isset($_SESSION['nama']) || !isset($_SESSION['id']); //defatultnya tidak ada
      if ($cekSes) {
        echo "salah";
      }else {
        //echo "betul";
        $pek = "Selamat Datang "."<b>".$_SESSION['nama']; $id =$_SESSION['id'];
      }
      ?>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('ProdCont/ListMyProd')?>">My Produk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('HomeCont/AllProduck')?>">Produk Beli</a>
      </li>
      <li class="nav-item">
        <?php
        if ($cekSes==false) {
          $nama =$_SESSION['nama'];
          echo '<span class="nav-link">Selamat datang '.'<b>'.$nama.'</b>'.'</span>';
        }?>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('ProdCont/formTambahProd')?>">Add new Produk</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('')?>">Pesanan</a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link" href="<?php echo site_url('RegisterPenggunaCont/logOut')?>">Logout</a>
      </li>
    </ul>
    </div>
    </nav>
  </body>
</html>
