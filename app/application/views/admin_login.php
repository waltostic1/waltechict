<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("head.php");
$this->load->view("script.php"); ?>

<body>
  <h1 class=" h3 text-left"><a href="<?=base_url('../view')?>">Bitnitro</a></h1>


  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth bg-primary">
        <div class="card col-lg-4 mx-auto p-0 ">
            <div class="card-body px-lg-5 px-1 py-5">
              <h3 class="card-title text-left mb-3">Admin Login <a href="<?= base_url('logout')?>" class="float-right h5">Logout</a></span></h3>
              <?php
              echo $this->session->flashdata('form');
              $this->session->set_flashdata('form', '');

              $attributes = array('role' => 'form', 'enctype' => 'multipart/form-data');
              echo form_open(base_url('admin_login/login'), $attributes);
              
              ?>

              <style>
                form span p {
                  background-color: orangered !important;
                  color: white !important;
                  padding: 2px;
                }
              </style>

<p class="text-danger p-1"><?php echo $this->session->userdata("loginError") ?></p>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" required placeholder="Enter admin's email" class="form-control p_input" id="email" name="email" value="<?php echo set_value('email') ?>">
                <span class="text-danger"> <?php echo form_error('email') ?> </span>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" required placeholder="Enter password" id="password" name="password" class="form-control p_input" value="<?php echo set_value('password') ?>">
                <span class="text-danger"> <?php echo form_error('password') ?> </span>
              </div>  
              <div class="text-left my-3">
                <input type="submit" value="Login" name="login" class="btn btn-lg btn-success enter-btn btn-block">
              </div>
                          
              <?php echo form_close() ?>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- footer -->
  <?php $this->load->view("footer.php"); ?>
  <!-- end of footer -->

<?php 
$msg="<html><head><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'></head><body>";
$msg.="<h1 class='bg-danger text-light'>the lord is good all the time</h1>";
$msg.="</body></html>";

?>


</body>

</html>