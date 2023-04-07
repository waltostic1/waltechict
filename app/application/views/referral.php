<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("head.php");
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
<script>
  /* $(document).ready(function() {
    Swal.fire('Yes', 'no', 'info', 'icon');
  }); */
</script>

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

          <div class="row">
            <div class="">
              <h4 class="mt-3">Referral bonus</h4>             
            </div>

            <div class="table-responsive">
              <table class="table table-dark table-striped">
                <thead class=" text-uppercase">
                  <tr>
                    <th>Sn</th>
                    <th class="text-right">Amount</th>
                    <th>From</th>
                    <th>Comment</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  if ($fetch_ref_report->num_rows() > 0) {

                    $totalAmount = $sn = 0;
                    foreach ($fetch_ref_report->result() as $row) {
                      $sn++;
                      $downLine = $row->rr_downline_username;
                      $amount = $row->rr_bonus;
                      $date = $row->rr_date;
                      $comment=$row->rr_comment;
                      $totalAmount=$totalAmount+$amount;


                  ?>

                      <tr>
                        <td><?= $sn ?></td>
                        <td class="text-success text-right">$<?= $amount ?></td>
                        <td><?=$downLine?></td>
                        <td><?=$comment?></td>
                        <td><?= $date ?></td>
                      </tr>

                  <?php
                    }
                    echo "<tr><td colspan='5' class=' h1 p-4 text-light'>Total referral bonus received: <span class='h5 text-success'>" . $totalAmount . "</span></td></tr>";
                  } else {
                    echo "<tr><td colspan='5' class='text-center h1 p-4'>Hmm! no record found.</td></tr>";
                  }

                  ?>

                </tbody>
              </table>

            </div>


            <div class="col-12 jumbotron p-0"></div>
            <div class=" mt-4">
              <h4>Your referrals</h4>             
            </div>

            <div class="table-responsive">
              <table class="table table-dark table-striped">
                <thead class=" text-uppercase">
                  <tr>
                    <th>Sn</th>
                    <th>Username</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  if ($fetch_referral->num_rows() > 0) {
                    $totalAmount = $sn = 0;
                    foreach ($fetch_referral->result() as $row) {
                      $sn++;
                      $id = $row->user_id;
                      $username = $row->username;
                      $status = $row->status;
                      $date = $row->date;


                  ?>

                      <tr>
                        <td><?= $sn ?></td>
                        <td><?= $username ?></td>
                        <td><?= $date ?></td>
                      </tr>

                  <?php
                    }
                    echo "<tr><td colspan='3' class=' h1 p-4 text-light'>Total referral: <span class='h5 text-primary'>" . $sn . "</span></td></tr>";
                  } else {
                    echo "<tr><td colspan='3' class='text-center h1 p-4'>Hmm! no record found.</td></tr>";
                  }

                  ?>

                </tbody>
              </table>

            </div>

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