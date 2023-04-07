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
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth bg-primary">
        <div class="card col-lg-4 mx-auto p-0 ">
            <div class="card-body px-lg-5 px-1 py-5">
              <h3 class="card-title text-left mb-3">Reset your password <a href="<?= base_url('../view')?>" class="float-right h5">Home</a></h3>
              <?php
              echo $this->session->flashdata('form');
              $this->session->set_flashdata('form', '');

              $attributes = array('role' => 'form', 'enctype' => 'multipart/form-data');
              echo form_open(base_url('password_reset/save_password'), $attributes);
              
              ?>

              <style>
                form span p {
                  background-color: orangered !important;
                  color: white !important;
                  padding: 2px;
                }
              </style>

              
              <div class="form-group">
                <label for="new_password">Enter your new password</label>
                <input type="hidden" name="acc_type" value="<?=$account_type?>">
                <input type="hidden" name="email" value="<?=$email?>">
                <input type="hidden" name="link" value="<?=$link?>">
                <input type="text" required placeholder="Enter new password" class="form-control p_input" id="new_password" name="new_password" value="<?php echo set_value('new_password') ?>">
                <span class="text-danger"> <?php echo form_error('new_password') ?> </span>
              </div>
               
              <div class="text-left my-3">
                <input type="submit" value="Save" name="reset" class="btn btn-lg btn-success enter-btn btn-block">
              </div>
              <p class="sign-up text-light text-center col-12">Remember password? <a class="btn-link" href="<?php echo base_url('login') ?>">Login</a></p>
                         
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