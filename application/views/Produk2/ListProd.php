<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ListMyProd</title>
    <?php $this->load->view('cssjsview/file') ?>

  </head>
  <body>
    <style media="screen">
      .bung{
        margin-left: 70px;
        margin-top: 80px;


      }
    </style>
  <div class="bung">
    <h2 >Produk yang anda jual</h2>
    <table id="tabel-prod" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th >No</th>
          <th >nama</th>
          <th >kategori</th>
          <th >gambar</th>
          <th >stok</th>
          <th scope="col">harga</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $idUsr = $_SESSION['id'];
        $tgl = $_SESSION['created'];
        $lis = $this->db->get_where('produk1',['idPengguna'=>$idUsr]);
        foreach ($lis->result() as $em)
            { ?>
      <tr>
          <th ><?php echo $em->id; ?></th>
          <td><?php echo $em->nama; ?></td>
          <td><?php echo $em->kategori; ?></td>
          <td>   <img class="" width="100" height="100" src="<?php echo base_url('fotoProduk/').$em->foto;?>" ><br></td>
          <td><?php echo $em->stok; ?></td>
          <td><?php echo $em->harga; ?></td>
          <td>
            <a href="<?php echo site_url('ProdCont/Delete/').$em->id;?>" class="btn btn-danger">Delete</a>
            <a href="<?php echo site_url('ProdCont/FormEditMyprod/').$em->id;?>" class="btn btn-info">Edit</a>
          </td>
      </tr>
      <?php    } ?>
      </tbody>
    </table>


  </div>
  <?php $this->load->view('cssjsview/datatables.php') ?>
    <script type="text/javascript">
    $(document).ready(function() {
      $('#tabel-prod').DataTable();
    });
    </script>

  </body>
</html>
