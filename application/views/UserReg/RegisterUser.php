<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Form Register Pengguna Baru</title>
    <?php $this->load->view('cssjsview/file') ?>
    <style media="screen">
      .wrap{
        display: flex;
      }
      .tess{
        margin-top: 200px;
        width: 800px;
        height: 500px;
        margin-right:400px;
        margin-left: 400px;
      }
    </style>
  </head>
  <body>
    <div class="billing-address wrap">
          <div class="column tess">
              <h2>Register User Baru</h2>
          <?php echo form_open('RegisterPenggunaCont/ProsesRegister'); ?>
            <div class="col-md-6">
                <label> Name</label>
                <input class="form-control" type="text" name="name" placeholder="First Name">
            </div>
            <div class="col-md-6">
                <label>alamat</label>
                <input class="form-control" name="address" type="text" placeholder="address">
            </div>
            <div class="col-md-6">
                <label>password</label>
                <input class="form-control" name="pass" type="text" placeholder="password">
            </div><br>
            <div class="col-md-6">
                <label>password</label>
                <input class="form-control" name="pass" type="text" placeholder="password">
            </div><br>
            <div class="">
                <input type="submit" class="btn btn-info" value="REGISTER">
                <a href="<?php echo site_url();?>/RegisterPenggunaCont/login" class="btn btn-warning">login</a>
            </div>
          <?php echo form_close(); ?>
        </div>
    </div>

  </body>
</html>
