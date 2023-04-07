<!DOCTYPE html>
<html lang="en">

<head>
  <?php require('head.php');
 //echo md5(md5('mine'));
  ?>
</head>

<body>

  <div id='parent-div' class="col-12 bg-light m-0 p-0">
    <!--header-->
    <header class="">
      <?php require('header.php'); ?>
    </header>
    <!-- end header -->

    <div id="content" class="container col-12 p-5">
    <div class="container breadcrumb col-sm-12 col-md-4">
    <div class="col-12">
      
    <div class="col-12 text-center my-3 ">
        <h5 class="title text-primary font-weight-bold">
          <u>Staff Login</u>
        </h5>
      </div>
    
      <div class="text-center text-danger  col-12">
        <!--get login error -->
        <span><?php echo $this->session->userdata('loginError') ?></span>
        <?php $this->session->unset_userdata('loginError') ?>

      </div>
      <form id="loginform" method="post" name="loginform" action="<?php echo base_url('staff_login/process') ?>">
        <input type="hidden" name="csrftoken" value="ea49375f43c7e6a59c77df1e4de562b3f1350124eeb70e5d5124e4ce3b5251c2b4d12e9aaf2a3ddc618c178c8dc4620b">

        <div class="form-group my-4">

          <span class="input-group-addon"><i class="fa fa-user"></i> Email</span>
          <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>">
          <span class="text-danger "> <?php echo form_error('email') ?> </span>

        </div>

        <div class="form-group my-4">
          <span class="input-group-addon"><i class="fa fa-lock"></i> Password:</span>
          <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>">
          <span class="text-danger"> <?php echo form_error('password') ?> </span>

        </div>
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox"> Remember me
            </label>
          </div>
        </div>
        <div class="form-group text-right">
          <input type="submit" class="btn btn-primary" name="login" value="Login">
        </div>
        
      </form>
    </div>
    <!-- end login -->

  </div>
    </div>

    <footer class="footer">
      <?php require('footer.php') ?>
    </footer>
    <!-- end footer -->
  </div>

</body>

</html>