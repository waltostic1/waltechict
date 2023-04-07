<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("head.php");
$this->load->view("script.php"); ?>

<body>
<a href="..\view"><h1 class=" h3 text-left">Bitnitro</h1></a>
     <!-- google traslator div-->
     <div class="col-12 container">
         <div id="google_translate_element"></div>
     </div>
     <!-- end of google traslator div -->

     <!-- google translator script -->
     <script type="text/javascript">
         function googleTranslateElementInit() {
             new google.translate.TranslateElement({
                 pageLanguage: 'en'
             }, 'google_translate_element');
         }
     </script>
     <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
     <!-- end of google translator script -->


  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth bg-light">
          <div class="card col-lg-4 mx-auto p-0 ">
            <div class="card-body px-lg-5 px-1 py-5 ">
              <h3 class="card-title text-left mb-3">Register</h3>
              <!-- <form role="form" method="post" enctype="multipart/form-data"> -->
              <?php
              // echo $this->session->flashdata('form');
              $attributes = array('role' => 'form', 'enctype' => 'multipart/form-data');
              echo form_open(base_url('register/register'), $attributes);
              ?>
              <style>
               form span p{
                  background-color: orangered !important;
                  color: white !important;
                  padding: 2px;
                }
                </style>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" placeholder="enter your username" name="username" id="username" class="form-control p_input" value="<?php echo set_value('username') ?>">
                <span class="text-danger form-error">
                  <?php $error = form_error('username');
                  if ($error == '<p>The username field must contain a unique value.</p>') {
                    echo '<p>' . set_value('username') . " is already taken please try another one</p>";
                  } else {
                    echo $error;
                  }
                  ?>
                </span>
              </div>
               
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="enter your email" class="form-control p_input" value="<?php echo set_value('email') ?>">
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
                <input type="password" placeholder="enter your password" id="password" name="password" class="form-control p_input" value="<?php echo set_value('password') ?>">
                <span class="text-danger"> <?php echo form_error('password') ?> </span>
              </div>

              <div class="form-group">
                <label for="ref">Ref. | up-liner username (optional)</label>
                <input type="text" placeholder="who brought you in" name="ref" id="ref" class="form-control p_input" value="<?php echo $this->session->userdata('session_ref_username') ?>">
                <span class="text-danger"> <?php  echo form_error('ref') ?> </span>
              </div>

              <div class="text-left mb-3" >
                <input type="submit" class="btn  btn-lg btn-success enter-btn btn-block" name="register" value="Register">
              </div>
              <div class="container p-2 my-2">
                <p class="sign-up text-center col-12">Already have an Account? <a class="btn-link" href="<?php echo base_url('login') ?>"> Login</a></p>
                <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
              </div>
              
              <?php echo form_close()?>
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