<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CRUD Produk</title>
      <?php $this->load->view('cssjsview/file') ?>
      <link rel="stylesheet" href="<?php echo base_url("/templete/Kustom.css");?>">
  </head>
  <body>


    <div class="posForm widthInput">
        <?php echo form_open_multipart('ProdCont/tambahProduk'); ?>
        <h1>Tambah Produk</h1>
        <?php $ppk =$_SESSION['id']; ?>
      <input type="hidden"  name="idPeng" value='<?php echo "$ppk"; ?>' class="form-control" aria-describedby="emailHelp">

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
      <div class="form-group">
        <label for="phone">Foto</label>
        <input required type="file" id="fotoProduk" name="fotoProduk" class="form-control" id="">
      </div>
      <input type="submit" name="addEmploye" class="btn btn-primary" value="Save">
      <?php echo form_close(); ?>
    </div>
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        var elements = document.getElementsByTagName("input");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function(e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("harap diisi jangan sampe kosong");
                }
            };
            elements[i].oninput = function(e) {
                e.target.setCustomValidity("");
            };
        }
      })
    </script>
  </body>
</html>
