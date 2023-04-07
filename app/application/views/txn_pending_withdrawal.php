<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view('txn_head') ?>

</head>


<body>

  <div class="">


    <table class="alert-info p-0" style="width: 90%; margin:auto">
      <tr>
        <td colspan="2">
          <?php $this->load->view('txn_header') ?>
        </td>
      </tr>
      <tr>

        <td style="min-width:200px;vertical-align: top;">

          <?php $this->load->view('txn_nav.php') ?>
        </td>
        <td>
          <div class="bg-light p-2">

            <style>
              table #my-table tbody tr td {
                padding: 5px !important;
              }
            </style>

            <table id="my-table" class="display table nowrap table-striped table-bordered ">
            <h4 class="p-3">Withdrawal request</h4>
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th class="text-right">Amount</th>
                  <th>Wallet | Wallet address</th>
                  <th>Date</th>
                  <th>Action </th>
                </tr>
              </thead>
              <tbody>


                <?php
                if ($fetch_pending_withdrawal->num_rows() > 0) {
                  $total_wd_amount = $sn = 0;

                  $total_dpt_amount = 0;
                  foreach ($fetch_pending_withdrawal->result() as $row) {
                    $sn++;
                    $wd_id = $row->wd_id;
                    $wd_username = $row->wd_username;
                    $wd_user_wallet_name = $row->wd_user_wallet_name;
                    $wd_user_wallet_address = $row->wd_user_wallet_address;
                    $wd_amount = $row->wd_amount;
                    $wd_status = $row->wd_status;
                    $wd_date = $row->wd_date;
                    $total_wd_amount = $total_wd_amount + $wd_amount;
                    if ($wd_status == 1) {
                      $status_report = "<i class='text-success'>approved</i>";
                    } else if ($wd_status == 0) {
                      $status_report = "<i class='text-warning'>pending</i>";
                    } else {
                      $status_report = "<i class=' text-muted'>unknown</i>";
                    }

                ?>

                    <tr>
                      <td class="text-right"><?= $sn ?></td>
                      <td><?= $wd_username ?></td>
                      <td class="text-right text-primary">$<?= number_format($wd_amount,2) ?></td>
                      <td><?= $wd_user_wallet_name . " | " . $wd_user_wallet_address ?></td>                      
                      <td><?= $wd_date ?></td>
                      <td>
                        <button class="btn-pay-cancel btn btn-sm btn-primary" wd_amount="<?= $wd_amount ?>" wd_username="<?= $wd_username ?>" wd_user_wallet_address="<?= $wd_user_wallet_address ?>" wd_user_wallet_name="<?= $wd_user_wallet_name ?>" wd_id="<?= $wd_id ?>" data-toggle="modal" data-target="#manual-pay"> Pay | cancel </button>
                       </td>

                    </tr>
                
                <script>
                 $(document).ready(function() {
                  $(".btn-pay-cancel").click(function() {
      var wd_amount = $(this).attr("wd_amount");
      var wd_username = $(this).attr("wd_username");
      var wd_user_wallet_address = $(this).attr("wd_user_wallet_address");
      var wd_user_wallet_name = $(this).attr("wd_user_wallet_name");
      var wd_id = $(this).attr("wd_id");
      $("#show-username").html(wd_username);
      $("#show-payment-system").html(wd_user_wallet_name);
      $("#show-payee-wallet-id").html(wd_user_wallet_address);
      $("#show-amount").html('$'+wd_amount);
      $("#wallet-id").val(wd_user_wallet_address);
      $("#txn-id").val(wd_id);
      $("#tracking-id").val("");


    });
    //$(".hidden-div").css("display","none");
  });
                  
                </script>

                <?php
                  }
                } else {
                  $report = "<tr> <td colspan='6' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
                }

                ?>

              </tbody>
              <tfoot><?php
                      if (isset($total_wd_amount)) {
                        echo '<tr><td colspan="5">Total requested amount: <span class="text-success h6">$' . number_format($total_wd_amount,2) . '</span></td></tr>';
                      } ?>

              </tfoot>
            </table>
          </div>
        </td>

      </tr>
      <tr>
        <td colspan="2" class="bg-dark text-light p-2">copyright@bitnitro.com</td>
      </tr>
    </table>



    <?php $this->load->view('txn_script') ?>
  </div>

  <!-- manual pay modal -->

  <!-- Modal -->
  <div class="modal fade" data-backdrop="static" id="manual-pay" role="dialog">

    <div class=" modal-dialog modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Manual Process Withdrawal</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="">
            <style>
              .modal-body table td {
                padding: 10px !important;
              }
            </style>
            <table class="table table-bordered ">
              <tr>
                <td class="text-right">Username: </td>
                <td id="show-username" class="text-primary"></td>
              </tr>
              <tr>
                <td class="text-right">Payment system: </td>
                <td id="show-payment-system" class="text-primary"></td>
              </tr>
              <tr>
                <td class="text-right">Payee wallet id: </td>
                <td><textarea readonly class="form-control border-0 bg-light text-primary p-0" id="show-payee-wallet-id"></textarea></td>
              </tr>
              <tr>
                <td class="text-right ">Amount: </td>
                <td id="show-amount" class="text-primary"></td>
              </tr>
              <tr>
                <td class="text-right">Payment tracking id: </td id="tracking-id">
                <td><input type="text" class="form-control text-primary" id="tracking-id" placeholder="enter payment tracking id"></td>
              </tr>
              <tr>
                <td colspan="2">
                  <input id="txn-id" readonly type="hidden" class="form-control">
                  <button id="confirm-txn" class="btn my-2 btn-primary btn-block mdi mdi-check-outline "> Confirm transaction</button>
                  <button id="cancel-txn" class="btn my-4 btn-danger btn-block mdi mdi-trash-can"> Cancel transaction</button>
                  <p id="pay-response"></p>
                </td>
              </tr>

            </table>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
        </div>

      </div>
    </div>
  </div>

  <!-- end of cast voting modal -->

</body>

<script>
  $(document).ready(function() {

    $("#confirm-txn").click(function() {
      var trackingId = $("#tracking-id").val().replaceAll(" ", "");
      var txnId = $("#txn-id").val(); // where txn id is the withdrawal id in the withdrawal table
      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

      //alert (trackingId);return;

      if (trackingId == "") {
        Swal.fire("Invalid tracking id", "please enter tracking id", "error");
        $("#tracking-id").val("");
        return;
      }
      $('#pay-response').html("<i>processing please wait..</i>")
      $.ajax({

        url: "<?php echo base_url('txn_pending_withdrawal/settle_txn'); ?>",
        method: 'POST',
        data: {
          trackingId: trackingId,
          txnId: txnId,
          <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
        },
        success: function(data) {
          $("#pay-response").html(data);
        }
      });


    });


    // delete txn
    $("#cancel-txn").click(function() {
      
      var txnId = $("#txn-id").val(); // where txn id is the withdrawal id in the withdrawal table
      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';


      Swal.fire({
        title: '<h5>Withdrawal request will be canceled</h5>',
        text: 'Are you sure you want to carry out this action?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        icon: 'info'
      }).then((result) => {
        if (result.isConfirmed) {

          $('#pay-response').html("<i>processing please wait..</i>")
      $.ajax({
        url: "<?php echo base_url('txn_pending_withdrawal/cancel_txn'); ?>",
        method: 'POST',
        data: {
          txnId: txnId,
          <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
        },
        success: function(data) {
          $("#pay-response").html(data);
        }
      });


        }
      });


    });

  });
</script>

</html>