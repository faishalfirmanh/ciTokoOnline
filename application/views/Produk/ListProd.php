<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ListMyProd</title>
    <?php $this->load->view('cssjsview/file') ?>
  </head>
  <body>
    <table class="table table-bordered" style="width:70%;">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">nama</th>
          <th scope="col">kategori</th>
          <th scope="col">stok</th>
          <th scope="col">harga</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $lis = $this->db->get('produk1');
        foreach ($lis->result() as $em)
            { ?>
      <tr>
          <th scope="row"><?php echo $em->id; ?></th>
          <td><?php echo $em->nama; ?></td>
          <td><?php echo $em->kategori; ?></td>
          <td><?php echo $em->stok; ?></td>
          <td><?php echo $em->harga; ?></td>
          <td>
            <a href="<?php echo site_url('').$em->id;?>" class="btn btn-danger">Delete</a>
            <a href="<?php echo site_url('').$em->id;?>" class="btn btn-info">Edit</a>
          </td>
      </tr>
      <?php    } ?>
      </tbody>
    </table>
  </body>
</html>
