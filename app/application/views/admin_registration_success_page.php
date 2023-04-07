<!DOCTYPE html>
<html lang="en">

<head>
  <?php require('head.php');
  ?>

</head>

<body>

  <div id='parent-div' class="col-12 bg-dark m-0 p-0">
    <!--header-->
    <header class="">
      <?php require('header.php'); ?>
    </header>
    <!-- end header -->


    <div id="content" class="container col-12 bg-secondary p-5">
      <div class="container bg-light p-4 col-sm-12 col-md-12">

        <!--success message here-->

        <div text-center class="text-success alert alert-dismissible fade show" role="alert">

          <div class=" text-center">
            <!-- <button type="button" class="btn-close close  float-right " data-dismiss="alert" aria-label="Close">X</button> -->
            <h1 class="text-center my-2">Congratulations! your registration was successful.</h1>            
            <p><br></p>
            <a href="<?php echo base_url('admin_login') ?>" class="btn btn-sm btn-primary">Login</a>
           
          </div>


        </div>

        <!--end of success message -->


      </div>
    </div>


    <footer class="footer mt-5">
      <?php require('footer.php') ?>
    </footer>
    <!-- end footer -->
  </div>

</body>

</html>