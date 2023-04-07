<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("head.php");

$this->load->view("script.php"); ?>


<body>

  <div class="container-scroller">

    <!-- sidebar -->

    <?php $this->load->view("admin_sidebar.php"); ?>
    <!-- end of sidebar -->

    <div class="container-fluid page-body-wrapper">

      <!-- navbar -->
      <?php $this->load->view("admin_navbar") ?>
      <!-- end of navbar -->

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="">
              <h4>Disapproved | unconfirmed deposit</h4>
            </div>
            <div class="table-responsive">
              <table class="table table-dark table-striped">
                <thead class=" text-uppercase">
                  <tr>
                    <th>Sn</th>
                    <th>package</th>
                    <th>Amt</th>
                    <th class="alert-primary">Sender's wallet address</th>
                    <!-- <th>Receiver | Company</th> -->
                    <th>Currency</th>
                    <!-- <th>Income</th> -->
                    <th>Date</th>
                    <th class="alert-primary">Action </th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  if ($fetch_disapproved_deposit->num_rows() > 0) {
                    $sn = 0;
                   
                    $total_dpt_amount = 0;
                    foreach ($fetch_disapproved_deposit->result() as $row) {
                      $sn++;
                      $dpt_id = $row->dpt_id;
                      $dpt_sender_id = $row->dpt_user_id;
                      $dpt_user_id=$row->dpt_user_id; // user_id=depositor's id
                      $dpt_package_name = $row->dpt_package_name;
                      $dpt_package_id = $row->dpt_package_id;
                      $dpt_amount = $row->dpt_amount;
                      $total_dpt_amount = $total_dpt_amount + $dpt_amount;
                      $dpt_pkg_due_day = $row->dpt_pkg_due_day;
                      $dpt_pkg_interest_rate = $row->dpt_pkg_interest_rate;
                      $dpt_total_income = $row->dpt_total_income;
                      $dpt_wallet_name = $row->dpt_wallet_name;
                      $dpt_wallet_address = $row->dpt_wallet_address;
                      $dpt_company_wallet_address = $row->dpt_company_wallet_address;
                      $dpt_status = $row->dpt_status;
                      if ($dpt_status == 1) {
                        $status_report = "<i class='text-success'>approved</i>";
                      } else if ($dpt_status == 0) {
                        $status_report = "<i class='text-warning'>waiting for approval</i>
                                                <button class='cancel-btn btn btn-sm btn-danger ml-2' id='" . $dpt_id . "'>Cancel txn</button>";
                      } else {
                        $status_report = "<i class=' text-muted'>unknown</i>";
                      }
                      $dpt_date = $row->dpt_date;
                      $dpt_pkg_due_day > 1 ? $surfix = "days" : $surfix = "day";




                  ?>

                      <tr>
                        <td><?= $sn ?></td>
                        <td><?= $dpt_package_name ?></td>
                        <td>$<?= $dpt_amount ?></td>
                        <td class="alert-primary"><?= $dpt_wallet_address ?></td>
                        <!-- <td title="<?//= $dpt_company_wallet_address ?>"><?//= substr($dpt_company_wallet_address, 0, 20) ?>...</td> -->
                        <td><?= $dpt_wallet_name ?></td>
                        <!-- <td>$<?= $dpt_total_income ?></td> -->
                        <td><?= $dpt_date ?></td>
                        <td class="alert-primary">
                        <button class="button-approve btn btn-sm btn-primary" data-sender-id="<?= $dpt_sender_id ?>" data-user-id="<?= $dpt_user_id ?>" data-dpt-amount="<?= $dpt_amount ?>" data-approve-id="<?= $dpt_id ?>">approve</button>
                        
                          <p id="action-txn-response-<?= $dpt_id ?>"></p>
                        </td>

                      </tr>

                  <?php
                    }
                  } else {
                    echo "<tr> <td colspan='9' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
                  }

                  if (isset($total_dpt_amount)) {
                    echo '<tr><td colspan="9">Total amount deposited: <span class="text-primary h6">$' . $total_dpt_amount . '</span></td></tr>';
                  }
                  ?>
                </tbody>
              </table>

              <script>
                $(document).ready(function() {


                                    //approve transaction
                                    $('.button-approve').click(function() {
                    
                    var txnId = $(this).attr('data-approve-id');
                    var initialDeposit = $(this).attr('data-dpt-amount'); 
                    var userId = $(this).attr('data-user-id');   // userId=depositor's id                 
                    var txnSenderId = $(this).attr('data-sender-id');
                    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

                    Swal.fire({
                      title: '<h5>Transaction will be approved and investor will be credited.</h5>',
                      text: 'Are you sure you want to carry out this action?',
                      showDenyButton: true,
                      confirmButtonText: 'Yes',
                      denyButtonText: 'No',
                      icon: 'info'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $.ajax({

                          url: "<?php echo base_url('disapproved_deposit/approveTxn'); ?>",
                          method: 'POST',
                          data: {
                            txnId: txnId,
                            userId:userId,
                            initialDeposit:initialDeposit,
                            txnSenderId: txnSenderId,
                            <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                          },
                          success: function(data) {
                            $("#action-txn-response-" + txnId).html(data);
                          }
                        });

                      }
                    })

                  });

                  //approve transaction
                  /*
                  $('.button-approve').click(function() {

                    var txnId = $(this).attr('data-approve-id');
                    var txnSenderId = $(this).attr('data-sender-id');
                    var csrf_hash = '<?php //echo $this->security->get_csrf_hash(); ?>';

                    Swal.fire({
                      title: '<h5>Transaction will be approved and investor will be credited.</h5>',
                      text: 'Are you sure you want to carry out this action?',
                      showDenyButton: true,
                      confirmButtonText: 'Yes',
                      denyButtonText: 'No',
                      icon: 'info'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $.ajax({

                          url: "<?php // echo base_url('pending_deposit/approveTxn'); ?>",
                          method: 'POST',
                          data: {
                            txnId: txnId,
                            txnSenderId: txnSenderId,
                            <?php //echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                          },
                          success: function(data) {
                            $("#action-txn-response-" + txnId).html(data);
                          }
                        });

                      }
                    })

                  });*/

                  // end of approve cmd


                  //disapprove transaction
                  $('.button-disapprove').click(function() {

                    var txnId = $(this).attr('data-disapprove-id');
                    var txnSenderId = $(this).attr('data-sender-id');
                    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

                    Swal.fire({
                      title: '<h5>Transaction will be disapproved and investor will not be credited.</h5>',
                      text: 'Are you sure you want to carry out this action?',
                      showDenyButton: true,
                      confirmButtonText: 'Yes',
                      denyButtonText: 'No',
                      icon: 'info'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $.ajax({

                          url: "<?php echo base_url('disapproved_deposit/disapproveTxn'); ?>",
                          method: 'POST',
                          data: {
                            txnId: txnId,
                            txnSenderId: txnSenderId,
                            <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                          },
                          success: function(data) {
                            $("#action-txn-response-" + txnId).html(data);
                          }
                        });

                      }
                    })

                  });

                });
              </script>

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