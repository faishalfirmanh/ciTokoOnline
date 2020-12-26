<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Details Produk</title>
  </head>
  <body>
<style media="screen">
  .bung{
    margin-left: 40px;
  }
</style>
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
        echo "<h3 class='bung' style='background-color:rgb(52,156,252);width:400px;height:100px;'>dapat promo  30%</h3>";
        foreach ($prod->result() as $ll)
          {
          $rp = number_format($ll->harga);
          $rup =  $ll->harga;
          $namaBarang =  $ll->nama;
          $idUser =  $idPel;
          $idProdukkk =  $idProduknya;
          $buka =  form_open_multipart('OrderCont/orderBarang');
          $tutup =  form_close();
          echo
          "
          <div class='bung'>
            $buka
            <h3>$namaBarang</h3>
            <label id='rp' hidden>$rup</label>
            <label ><b>Harga</b> Rp. $rp</label>
            <div class='form-group'>
              <input type='text' hidden  name='idPeng' value=$idUser class='form-control'>
              <input type='text' hidden name='idProd' value=$idProdukkk class='form-control' >
              <label for='name'>jumlah Beli</label>
              <input onkeyup='promonya()' type='number'  id='jumlahBeli' name='totalBeli' placeholder='input jumlah' class='form-control'>
              <label for='name'>Foto Transver</label>
              <input required type='file' name='userfile' placeholder='input foto' class='form-control'>
              <br><br>
              <p>TOTAL bayar</p><del><h4 style='color:red' id='harusBayar'></h4></del><br>
              <p>mendapat potngan jadi bayar <h3 style='color:rgb(61,150,255)' id='harusBayarPromo'></h3><p>
              <input type='submit' class='btn btn-info'  value='save'>
            </div>
            '.$tutup.'
          </div>
          ";
          }

      }else {
        echo "<h3 style='margin-left:40px;margin-top:40px;background-color:rgb(230,56,10);color:white;width:400px;height:100px;'>anda user baru
        tidak ada potongan
        </h3>";
      foreach ($prod->result() as $ll)
        {
        $rp = number_format($ll->harga);
        $rup =  $ll->harga;
        $namaBarang =  $ll->nama;
        $idUser =  $idPel;
        $idProdukkk =  $idProduknya;
        $buka =  form_open_multipart('OrderCont/orderBarang');
        $tutup =  form_close();
        echo
        "
        <div class='bung'>
          $buka
          <h3>$namaBarang</h3>
          <label id='rp' hidden>$rup</label>
          <label ><b>Harga</b> Rp. $rp</label>
          <div class='form-group'>
            <input type='text' hidden  name='idPeng' value=$idUser class='form-control'>
            <input type='text' hidden name='idProd' value=$idProdukkk class='form-control' >
            <label for='name'>jumlah Beli</label>
            <input onkeyup='tekanJumlah()' type='number'  id='jumlahBeli' name='totalBeli' placeholder='input jumlah' class='form-control'>
            <label for='name'>Foto Transver</label>
            <input required type='file' name='userfile' placeholder='input foto' class='form-control'>
            <br><br>
            <p>TOTAL bayar Harga </p><h4 id='harusBayar'></h4><br>

            <input type='submit' class='btn btn-info'  value='save'>
          </div>
          '.$tutup.'
        </div>
        ";
        }

      }

    ?>
      <script type="text/javascript">
        function tekanJumlah(){
          let jumlhBarng = document.getElementById('jumlahBeli').value;
          let harg = document.getElementById('rp').textContent; //get value didalam tag html
          let total = harg * jumlhBarng;
          let formatTota = new Intl.NumberFormat().format(total) //format numper untuk mata uang
          document.getElementById('harusBayar').innerHTML =formatTota;
        }

        function promonya(){
          let jumlhBarng = document.getElementById('jumlahBeli').value;
          let harg = document.getElementById('rp').textContent; //get value didalam tag html
          let potongan = 70 /100;
          let hargsudhpot = harg *potongan
          let total = harg * jumlhBarng
          let totalPot = hargsudhpot * jumlhBarng
          let formatTota = new Intl.NumberFormat().format(total) //format numper untuk mata uang
          let formatTotaPOO = new Intl.NumberFormat().format(totalPot)
          document.getElementById('harusBayar').innerHTML =formatTota;
          document.getElementById('harusBayarPromo').innerHTML =formatTotaPOO;
        }
      </script>
  </body>
</html>
