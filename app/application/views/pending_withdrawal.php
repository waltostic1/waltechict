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
              <h4>Pending | unsettled withdrawal</h4>
              <p>Click the settled button once you have transfered the required amount to the reveiver's wallet address</p>
            </div>
            <div class="table-responsive">
              <table class="table table-dark table-striped">
                <thead class=" text-uppercase">
                  <tr>
                    <th>Sn</th>
                    <th class="text-success text-right">Amt</th>
                    <th>Wallet</th>                    
                    <th class="alert-primary">Receiver's wallet address</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-center alert-primary">Action </th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  if ($fetch_pending_withdrawal->num_rows() > 0) {
                   $total_wd_amount= $sn = 0;
                   
                    $total_dpt_amount = 0;
                    foreach ($fetch_pending_withdrawal->result() as $row) {
                      $sn++;
                      $wd_id = $row->wd_id;
                      $wd_user_wallet_name = $row->wd_user_wallet_name;
                      $wd_user_wallet_address = $row->wd_user_wallet_address;
                      $wd_amount = $row->wd_amount;
                      $wd_status = $row->wd_status;                      
                      $wd_date = $row->wd_date;
                      $total_wd_amount=$total_wd_amount+$wd_amount;
                      if ($wd_status == 1) {
                        $status_report = "<i class='text-success'>approved</i>";
                      } else if ($wd_status == 0) {
                        $status_report = "<i class='text-warning'>pending</i>";
                                                
                      } else {
                        $status_report = "<i class=' text-muted'>unknown</i>";
                      }




                  ?>

                      <tr>
                        <td><?= $sn ?></td>
                        <td class="text-success text-right">$<?= $wd_amount ?></td>
                        <td><?= $wd_user_wallet_name ?></td>
                        <td class="alert-primary"><?= $wd_user_wallet_address ?></td>
                        <td><?= $status_report ?></td>
                        <td><?= $wd_date ?></td>
                        <td class="alert-primary text-center"><button class="button-settled btn btn-sm btn-success" data-settled-id="<?= $wd_id ?>"><i class=" mdi mdi-check "></i>settled</button>
                         <p id="action-txn-response-<?= $wd_id ?>"></p>
                        </td>

                      </tr>

                  <?php
                    }
                  } else {
                    echo "<tr> <td colspan='9' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
                  }

                  if (isset($total_wd_amount)) {
                    echo '<tr><td colspan="7">Total unsettled amount: <span class="text-success h6">$' . $total_wd_amount . '</span></td></tr>';
                  }
                  ?>
                </tbody>
              </table>

              <script>
                $(document).ready(function() {


                  //settled transaction
                  $('.button-settled').click(function() {

                    var txnId = $(this).attr('data-settled-id');
                    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

                    Swal.fire({
                      title: '<h5>This transaction will disappear from the list.</h5>',
                      text: 'Are you sure you have made the transfer?',
                      showDenyButton: true,
                      confirmButtonText: 'Yes',
                      denyButtonText: 'No',
                      icon: 'info'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $.ajax({

                          url: "<?php echo base_url('pending_withdrawal/settledTxn'); ?>",
                          method: 'POST',
                          data: {

                            txnId: txnId,
                            <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                          },
                          success: function(data) {
                            $("#action-txn-response-" + txnId).html(data);
                          }
                        });

                      }
                    })

                  });

                  // end of approve cmd

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