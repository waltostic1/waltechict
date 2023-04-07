<!DOCTYPE html>
<html lang="en">
<?php
$this->load->view("head.php");
//require('login_session.php');
$this->load->view("script.php");

if ($get_user_info->num_rows() > 0) {
  $userId = $this->session->userdata('user_id');
  foreach ($get_user_info->result() as $row) {

    $username = $row->username;
    $fullName = $row->full_name;
    $email = $row->email;
    $phone = $row->phone;
    $upliner = $row->ref_username;
    $status = $row->status;
    $loginToken = $row->login_token;
    $photo = $row->photo;
    $totalAmount = $row->total_amount;
  }
}
?>

<body>

  <div class="container-scroller">

    <!-- sidebar -->

    <?php $this->load->view("sidebar.php"); ?>
    <!-- end of sidebar -->

    <div class="container-fluid page-body-wrapper">

      <!-- navbar -->
      <?php $this->load->view("navbar") ?>
      <!-- end of navbar -->

      <div class="main-panel">
        <div class="content-wrapper">


          <!-- get deposit -->
          <?php
          if ($get_deposit->num_rows() > 0) {
            $sn = 0;
            foreach ($get_deposit->result() as $row) {
              $sn++;
              $dpt_id = $row->dpt_id;
              $dpt_package_name = $row->dpt_package_name;
              $dpt_package_id = $row->dpt_package_id;
              $dpt_amount = $row->dpt_amount;
              $dpt_pkg_due_day = $row->dpt_pkg_due_day;
              $dpt_pkg_interest_rate = $row->dpt_pkg_interest_rate;
              $dpt_total_income = $row->dpt_total_income;
              $dpt_wallet_name = $row->dpt_wallet_name;
              $dpt_wallet_address = $row->dpt_wallet_address;
              $dpt_company_wallet_address = $row->dpt_company_wallet_address;
              $dpt_status = $row->dpt_status;
            }
          } ?>
          <!-- end of get deposit -->


          <!-- get pending deposit -->
          <?php
          $pending_sn = $pending_dpt_interest = $pending_dpt_total_amount = $pending_dpt_expected_income = 0;
          if ($get_pending_deposit->num_rows() > 0) {
            foreach ($get_pending_deposit->result() as $row_p) {
              $pending_sn++;
              $pending_dpt_total_amount = $pending_dpt_total_amount + $row_p->dpt_amount;
              $pending_dpt_expected_income = $pending_dpt_expected_income + $row_p->dpt_total_income;
              $pending_dpt_interest = ($pending_dpt_interest + ($pending_dpt_expected_income - $pending_dpt_total_amount));
            }
          } ?>
          <!-- end of get pending deposit -->



          <!-- get approved deposit -->
          <?php
          $approved_sn = $approved_dpt_interest = $approved_dpt_total_amount = $approved_dpt_expected_income = 0;
          if ($get_approved_deposit->num_rows() > 0) {
            foreach ($get_approved_deposit->result() as $row_p) {
              $approved_sn++;
              $approved_dpt_total_amount = $approved_dpt_total_amount + $row_p->dpt_amount;
              $approved_dpt_expected_income = $approved_dpt_expected_income + $row_p->dpt_total_income;
              $approved_dpt_interest = ($approved_dpt_interest + ($approved_dpt_expected_income - $approved_dpt_total_amount));
            }
          } ?>
          <!-- end of get approved deposit -->





          <!-- get unapproved deposit -->
          <?php
          $unapproved_sn = $unapproved_dpt_interest = $unapproved_dpt_total_amount = $unapproved_dpt_expected_income = 0;
          if ($get_unapproved_deposit->num_rows() > 0) {
            foreach ($get_unapproved_deposit->result() as $row_p) {
              $unapproved_sn++;
              $unapproved_dpt_total_amount = $unapproved_dpt_total_amount + $row_p->dpt_amount;
              $unapproved_dpt_expected_income = $unapproved_dpt_expected_income + $row_p->dpt_total_income;
              $unapproved_dpt_interest = ($unapproved_dpt_interest + ($unapproved_dpt_expected_income - $unapproved_dpt_total_amount));
            }
          } ?>
          <!-- end of get unapproved deposit -->



          <!--  get settled deposit  -->
          <?php
          $settled_sn = $settled_dpt_interest = $settled_dpt_total_amount = $settled_dpt_expected_income = 0;
          if ($get_settled_deposit->num_rows() > 0) {
            foreach ($get_settled_deposit->result() as $row_p) {
              $settled_sn++;
              $settled_dpt_total_amount = $settled_dpt_total_amount + $row_p->dpt_amount;
              $settled_dpt_expected_income = $settled_dpt_expected_income + $row_p->dpt_total_income;
              $settled_dpt_interest = ($settled_dpt_interest + ($settled_dpt_expected_income - $settled_dpt_total_amount));
            }
          } ?>
          <!-- end of get settled deposit  -->


          <!--  get settled withdrawal  -->
          <?php
          $settled_wit_sn = $settled_wit_total_amount = 0;
          if ($get_settled_withdrawal->num_rows() > 0) {
            foreach ($get_settled_withdrawal->result() as $row_w) {
              $settled_wit_sn++;
              $settled_wit_total_amount = $settled_wit_total_amount + $row_w->wd_amount;
            }
          } ?>
          <!-- end of get settled withdrawal  -->




          <!--  get pending withdrawal  -->
          <?php
          $pending_wit_sn = $pending_wit_total_amount = 0;
          if ($get_pending_withdrawal->num_rows() > 0) {
            foreach ($get_pending_withdrawal->result() as $row_w) {
              $pending_wit_sn++;
              $pending_wit_total_amount = $pending_wit_total_amount + $row_w->wd_amount;
            }
          } ?>
          <!-- end of get pending withdrawal  -->




          <!-- deposit history -->
          <div class="col-12 mt-5 ">
            <h4>Deposit History</h4>
            <div class="row">

              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                <div class="card alert-info ">
                  <a href="<?= base_url('deposit_history') ?>" class="btn">
                    <div class="card-body">

                      <div class="row">
                        <h6 class=" font-weight-normal h5 text-dark">No. of txn:<?= $pending_sn ?> </h6>
                        <div class="col-12">
                          <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-primary">$<?= $pending_dpt_total_amount ?></h3>
                            <p class="text-success ml-2 mb-0 font-weight-medium">+ $<?= $pending_dpt_interest ?> <span class="text-dark h4"> = $<?= $pending_dpt_expected_income ?></span></p>
                          </div>
                        </div>
                      </div>
                      <h6 class=" font-weight-normal text-dark">Pending deposit | Expected income</h6>

                    </div>
                  </a>

                </div>
              </div>


              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                <div class="card alert-info ">
                  <a href="<?= base_url('deposit_history') ?>" class="btn">
                    <div class="card-body">

                      <div class="row">
                        <h6 class=" font-weight-normal h5 text-dark">No. of txn:<?= $approved_sn ?> </h6>
                        <div class="col-12">
                          <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-primary">$<?= $approved_dpt_total_amount ?></h3>
                            <p class="text-success ml-2 mb-0 font-weight-medium">+ $<?= $approved_dpt_interest ?> <span class="text-dark h4"> = $<?= $approved_dpt_expected_income ?></span></p>
                          </div>
                        </div>
                      </div>
                      <h6 class=" font-weight-normal text-dark">Approved deposit | Expected income</h6>

                    </div>
                  </a>

                </div>
              </div>


              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                <div class="card alert-info ">
                  <a href="<?= base_url('deposit_history') ?>" class="btn">
                    <div class="card-body">

                      <div class="row">
                        <h6 class=" font-weight-normal h5 text-dark">No. of txn:<?= $unapproved_sn ?> </h6>
                        <div class="col-12">
                          <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-primary">$<?= $unapproved_dpt_total_amount ?></h3>
                            <p class="text-success ml-2 mb-0 font-weight-medium">+ $<?= $unapproved_dpt_interest ?> <span class="text-dark h4"> = $<?= $unapproved_dpt_expected_income ?></span></p>
                          </div>
                        </div>
                      </div>
                      <h6 class=" font-weight-normal text-dark">Disapproved deposit | Expected income</h6>

                    </div>
                  </a>

                </div>
              </div>


              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                <div class="card alert-info ">
                  <a href="<?= base_url('deposit_history') ?>" class="btn">
                    <div class="card-body">

                      <div class="row">
                        <h6 class=" font-weight-normal h5 text-dark">No. of txn:<?= $settled_sn ?> </h6>
                        <div class="col-12">
                          <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-primary">$<?= $settled_dpt_total_amount ?></h3>
                            <p class="text-success ml-2 mb-0 font-weight-medium">+ $<?= $settled_dpt_interest ?> <span class="text-dark h4"> = $<?= $settled_dpt_expected_income ?></span></p>
                          </div>
                        </div>
                      </div>
                      <h6 class=" font-weight-normal text-dark">Settled deposit | Expected income</h6>

                    </div>
                  </a>

                </div>
              </div>
            </div>
          </div>
          <!-- end of deposit history -->


          <!-- withdrawal history -->
          <div class="col-12 mt-5 ">
            <h4>Withdrawal History</h4>
            <div class="row">



              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                <div class="card alert-info ">
                  <a href="<?= base_url('withdrawal_history') ?>" class="btn">
                    <div class="card-body">

                      <div class="row">
                        <h6 class=" font-weight-normal h5 text-dark">No. of txn:<?= $pending_wit_sn ?> </h6>
                        <div class="col-12">
                          <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-primary">$<?= $pending_wit_total_amount ?></h3>

                          </div>
                        </div>
                      </div>
                      <h6 class=" font-weight-normal text-dark">Total pending withdrawal</h6>

                    </div>
                  </a>

                </div>
              </div>


              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                <div class="card alert-info ">
                  <a href="<?= base_url('successful_withdrawal') ?>" class="btn">
                    <div class="card-body">

                      <div class="row">
                        <h6 class=" font-weight-normal h5 text-dark">No. of txn:<?= $settled_wit_sn ?> </h6>
                        <div class="col-12">
                          <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-primary">$<?= $settled_wit_total_amount ?></h3>

                          </div>
                        </div>
                      </div>
                      <h6 class=" font-weight-normal text-dark">Total settled withdrawal</h6>

                    </div>
                  </a>

                </div>
              </div>




            </div>
          </div>
          <!-- end of withdrawal history -->


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
<script>
  $(document).ready(function() {

    /*
        cvm = $('#castVoteModal');
        cvm.css('display', 'block');
        cvm.addClass('show');
        $(".close-my-modal").click(function() {
          cvm.css('display', 'none');
          cvm.removeClass('show');
        });
    */


    // if the user targets the modal through the sites url eg /dashboard#castVoteModal 
    if (window.location.href.indexOf('#castVoteModal') != -1) {
      //$('#myModal').modal('show');
      cvm = $('#castVoteModal');
      cvm.css('display', 'block');
      cvm.addClass('show');
      $(".close-my-modal").click(function() {
        cvm.css('display', 'none');
        cvm.removeClass('show');
      });
    }

  });
</script>

</html>