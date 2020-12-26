<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"  charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>beli </title>
    <?php $this->load->view('cssjsview/file') ?>
    <link rel="stylesheet" href="<?php echo base_url("/templete/Kustom.css");?>">
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

  </head>
  <body>
    <style media="screen">
      .wrap{
        background-color: rgb(222,187,162);
        display: flex;
        flex-wrap: wrap;
        margin-top: 100px;
        margin-left: 80px;
        width: 1900px;

      }
      .wrap .mo{
        border: solid 8px red;
        border-radius: 8px;
        background-color: rgb(112,246,125);
        margin: 10px;
        width: 240px;
        height: 240px;
        align-items: center;
        margin-bottom: 10px;
        margin-top: 10px;

      }
      .btnDetail{
        margin-left:10px;
        margin-top: 10px;
        margin-bottom: 10px;
      }
    </style>
    <label for="exampleInputEmail1">cari prod</label>
    <input type="text" class="form-control" id="keyword" aria-describedby="emailHelp" placeholder="Enter paroduct">
    <div class="wrap" id="allwrap">

      <?php
        $idUsr = $_SESSION['id'];
        $bukan = isset($idUsr);
      // $lis = $this->db->get_where('produk1',['idPengguna'=>5]);
        $lis = $this->db->query('SELECT * FROM produk1 WHERE idPengguna != '.$idUsr.' '); //SELETC db where tidak id user;
        foreach ($lis->result() as $em){ ?>

      <div class="mo" id="itemCard">
          <h5 id="nameProduct"><?php $kkk = $em->nama; echo $kkk;  ?></h5>
          <?php $cek = strpos($em->foto,'.');
          if ($cek < 1) {
          echo "<div style='margin-top:40px;'><h4 style='background-color:red;'>No Foto</h4></div>";
          echo "<br><div style='margin-top:20px'></div>";
        }else {
          $img =  base_url('fotoProduk/').$em->foto;
          echo' <img id="gmbr" style="filter:grayscale(100%)"  class="card-img-top" src='.$img.' width="50" height="100"><br>';
        }
          ?>
          <a  href="<?php echo site_url('OrderCont/btnDetailProduk/').$em->id; ?>" class="btn btn-info btnDetail">Detail</a>
          <div id="produkAda">
          </div>

      </div>
      <?php    }?>
    </div>
      <script type="text/javascript">
        let gmb = document.querySelectorAll('#gmbr')
        let listfix =[]
        let listprod = document.querySelectorAll('h5')
        let keyword = document.querySelector('input')
        let card = document.getElementsByClassName('wrap')
        let mm = document.getElementById('allwrap')
        gmb.forEach((item, i) => {
          item.addEventListener('mouseenter', function(e) {
            item.style.filter ='grayscale(0%)'
          });
        });

        gmb.forEach((item, i) => {
          item.addEventListener('mouseleave', function(e) {
            item.style.filter ='grayscale(100%)'
          });
        });

      listprod.forEach((item) => {
        let toText = item.textContent
        listfix.push(toText)
      });

      keyword.addEventListener('keyup', function(e) {
        let textinput = e.target.value.toLowerCase()
        let cari = listfix.indexOf(textinput)
        let totLeng = textinput.length
        if (cari <=-1) {
          console.log('not found');

          if ( totLeng=== 0) {
            var el = document.getElementById('lol')
            el.remove();
          }else {
            mm.innerHTML = '<H3 id="lol" style="background-color:red">NOT FOUND</H3>'
          }

        }else {
          if (totLeng === 0) {
            console.log(totLeng);
            console.log('remove');
          }else {
            var el = document.getElementById('lol')
            el.remove();
            let hasil = listfix[cari]
            let ada = document.createElement('li')
            ada.innerHTML =hasil
            let fixhasil = document.body.appendChild(ada)

          }
        }
      });





      </script>

  </body>
</html>
