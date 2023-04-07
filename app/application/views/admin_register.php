<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("head.php");
$this->load->view("script.php"); ?>

<body>
  <h1 class=" h3 text-left">Bitnitro</h1>
    <!-- check if admin already exists -->
<?php
if($fetch_admin->num_rows()>0){
  $this->session->set_flashdata('form', "<script>Swal.fire('Admin already exists!','Please login','info')</script>");
					echo '<script>window.open("' . base_url('admin_login') . '","_self")</script>';
				
}
?>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth bg-primary">
          <div class="card col-lg-4 mx-auto p-0 ">
            <div class="card-body px-lg-5 px-1 py-5 ">
              <h3 class="card-title text-left mb-3">Create system admin</h3>
              <!-- <form role="form" method="post" enctype="multipart/form-data"> -->
              <?php
              // echo $this->session->flashdata('form');
              $attributes = array('role' => 'form', 'enctype' => 'multipart/form-data');
              echo form_open(base_url('admin_register/process'), $attributes);
              ?>
              <style>
                form span p {
                  background-color: orangered !important;
                  color: white !important;
                  padding: 2px;
                }
              </style>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter admin's email address" id="email" class="form-control p_input" value="<?php echo set_value('email') ?>">
                <!-- <span class="text-danger"> <?php //echo form_error('email') ?> </span> -->
                <span class="text-danger form-error">
                  <?php $error = form_error('email');
                  if ($error == '<p>The email field must contain a unique value.</p>') {
                    echo '<p>' . set_value('email') . " is already taken please try another one</p>";
                  } else {
                    echo $error;
                  }

                  ?>
                </span>
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter admin's password" class="form-control p_input" value="<?php echo set_value('password') ?>">
                <span class="text-danger"> <?php echo form_error('password') ?> </span>
              </div>

              <div class="form-group">
                <label for="password">Re-enter Password</label>
                <input type="password" id="re-enter-password" name="reEnterPassword" placeholder="Re-enter admin's password" class="form-control p_input" value="<?php echo set_value('reEnterPassword') ?>">
                <span class="text-danger"> <?php echo form_error('reEnterPassword') ?> </span>
              </div>

              <div class="">
                <p class="text-danger">Note: The information provided above will be used to grant you access to the admin page, please keep it safe.</p>
              </div>
              <div class="text-left mb-3">
                <input type="submit" class="btn  btn-lg btn-success enter-btn btn-block" name="registerAccount" value="Create">
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
</body>

</html>