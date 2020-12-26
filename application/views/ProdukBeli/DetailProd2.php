<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Details Produk</title>
  </head>
  <body>

      <?php   $idProduknya = $this->uri->segment(3); ?>
      <?php $prod = $this->db->get_where('produk1',array('id'=>$idProduknya));
      $idPel = $_SESSION['id'];
      $tglBuat = $_SESSION['created'];
      $create = new DateTime($tglBuat); // Your date of birth
      $today = new Datetime(date('y-m-d'));
      $diff = $today->diff($create);
      $tahn = $diff->y;
      $bulan = $diff->m;
      $hari = $diff->d;
      // echo "$tglBuat";
      if ($tahn > 1 || $bulan >1 || $hari >30) {
        echo "dapat promo";
      }else {
        echo "maff user baru";


      }

      foreach ($prod->result() as $ll) {
        $rp = number_format($ll->harga);
        ?>
        <div class="">
        <?php echo form_open_multipart('OrderCont/orderBarang'); ?>
          <h3><?php echo $ll->nama; ?></h3>
          <label id="rp" hidden><?php echo $ll->harga; ?></label>
          <label ><b>Harga</b> Rp. <?php echo $rp; ?></label>
          <div class="form-group">
            <input type="text" hidden  name="idPeng" value='<?php echo "$idPel"; ?>' class="form-control" aria-describedby="emailHelp">
            <input type="text" hidden name="idProd" value='<?php echo "$idProduknya"; ?>' class="form-control" >
            <label for="name">jumlah Beli</label>
            <input onkeyup="tekanJumlah()"  type="number"  id="jumlahBeli" name="totalBeli" placeholder="input jumlah" class="form-control" id="" aria-describedby="emailHelp">
            <label for="name">Foto Transver</label>
            <input required type="file" name="userfile" placeholder="input foto" class="form-control">
            <br><br>
            <p>TOTAL bayar</p><h4 id="harusBayar"></h4><br>
            <input type="submit" class="btn btn-info" name="" value="save">
          </div>
          <?php echo form_close(); ?>
        </div>
      <?php }  ?>
      <script type="text/javascript">
        function tekanJumlah(){
          let jumlhBarng = document.getElementById('jumlahBeli').value;
          let harg = document.getElementById('rp').textContent; //get value didalam tag html
          let total = harg * jumlhBarng;
          let formatTota = new Intl.NumberFormat().format(total) //format numper untuk mata uang
          document.getElementById('harusBayar').innerHTML =formatTota;
        }
      </script>
  </body>
</html>
