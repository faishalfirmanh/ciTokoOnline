<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?php echo base_url("/bootstrap/css/bootstrap.min.css");?>">
    <script src="<?php echo base_url("bootstrap/js/bootstrap.min.js"); ?>"></script>
  </head>
  <body>
    <style media="screen">
      .lebar{
        margin-top: 20px;
        border: solid 5px rgb(250,216,161);
        margin-top: 50px;
        margin-left: 160px;
        width: 900px;
      }
    </style>
  <?php echo form_open('LoginCont/ProsesLogin'); ?>
  <div class="lebar">
      <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="text" required name="username" class="form-control" id="username" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" required  name="password"class="form-control" id="password">
      </div>
      <input type="submit" name="" class="btn btn-primary" value="LOGIN">
  </div>
  <?php echo form_close(); ?>


  </body>
</html>
