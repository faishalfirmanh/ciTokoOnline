<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Form Login</title>
    <?php  $this->load->view('cssjsview/file') ?>
  </head>
  <body>
    <style media="screen">
      .wrap{
        display: flex;
      }
      .tess{
        margin-top: 200px;
        width: 800px;
        height: 260px;
        padding: 15px;
        margin-right:400px;
        margin-left: 400px;
        /* border-radius: 10px;
        border: solid; */
      }
    </style>
<div class="tess">
  <?php echo form_open('RegisterPenggunaCont/LoginDua'); ?>
    <div class="col-md-6">
        <label> Username</label>
        <input class="form-control" type="text" name="username" placeholder="First Name">
    </div>
    <div class="col-md-6">
        <label>password</label>
        <input class="form-control" name="pass" type="text" placeholder="password">
    </div><br>
    <div class="">
        <input type="submit" class="btn btn-danger" value="login">
    </div>
  <?php echo form_close(); ?>
</div>

  </body>
</html>
