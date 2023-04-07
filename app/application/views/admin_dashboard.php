<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("head.php");

$this->load->view("script.php"); ?>


<body>

  <div class="container-scroller">

    <!-- sidebar -->

    <?php $this->load->view("admin_sidebar"); ?>
    <!-- end of sidebar -->

    <div class="container-fluid page-body-wrapper">

      <!-- navbar -->
      <?php $this->load->view("admin_navbar") ?>
      <!-- end of navbar -->

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
          
          <!-- add package card -->
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <h6 class="text-primary">Add new package</h6>
                    
                    </div>
                    <div class="col-3 p-0">
                      <a class="btn btn-sm btn-primary mdi mdi-library-plus " href="<?=base_url('package')?>">
                        Add
                      </a>
                    </div>
                  </div>
                  <h6 class="text-muted font-weight-normal pt-1">Packages are investment plans displayed to members</h6>
                </div>
              </div>
            </div>
            <!-- end of add package card -->
            
           
                      <!-- add package card -->
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <h6 class="text-primary">Add new cryptocurrency</h6>
                    
                    </div>
                    <div class="col-3 p-0">
                      <a class="btn btn-sm btn-primary mdi mdi-library-plus " href="<?=base_url('cryptocurrency')?>">
                        Add
                      </a>
                    </div>
                  </div>
                  <h6 class="text-muted font-weight-normal pt-1">Only added cryptocurrency will be displayed to members to trade with</h6>
                </div>
              </div>
            </div>
            <!-- end of add package card -->
            
            
                      <!-- add package card -->
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <h6 class="text-primary">Add company's wallet address</h6>
                    
                    </div>
                    <div class="col-3 p-0">
                      <a class="btn btn-sm btn-primary mdi mdi-library-plus " href="<?=base_url('wallet_address')?>">
                        Add
                      </a>
                    </div>
                  </div>
                  <h6 class="text-muted font-weight-normal pt-1">Admin can add and modify company's wallet addressess</h6>
                </div>
              </div>
            </div>
            <!-- end of add package card -->
            
            
                      <!-- add package card -->
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <h6 class="text-primary">View transactions</h6>
                    
                    </div>
                    <div class="col-3 p-0">
                     <a class="btn btn-sm btn-primary mdi mdi-library-plus " href="#ui-basic">
                        Add
                      </a>
                    </div>
                  </div>
                  <h6 class="text-muted font-weight-normal pt-1">Admin can view, approve and disapprove payments</h6>
                </div>
              </div>
            </div>
            <!-- end of add package card -->


          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- footer -->
        <?php $this->load->view("footer.php"); ?>
        <!-- end of footer -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?php //$this->load->view('script.php'); 
  ?>
</body>


</html>