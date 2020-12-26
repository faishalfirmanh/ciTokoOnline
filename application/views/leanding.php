<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php $this->load->view('link'); ?>
  </head>
  <body>
    <div class="card" style="width: 18rem;margin-top:80px;margin-left:100px;">
      <div class="card-body">
        <h5 class="card-title"><span class="nav-link"> <?php echo "Welcome "."<b>".$_SESSION['username']."</b>" ?></span></h5>
        <p class="card-text">THIS IS HOME PAGE LEANDING</p>
        <a href="<?php site_url('index.php/LoginCont/Logout') ?>" class="btn btn-danger">logout</a>
      </div>
    </div>


  </body>
</html>
