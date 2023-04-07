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
            <h4 class="p-3">Pending deposit</h4>
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Wallet | Wallet address</th>
                  <th class="text-right">Amount</th>
                  <th>Date</th>
                  <th>Action </th>
                </tr>
              </thead>
              <tbody>


                <?php
                if ($fetch_pending_deposit->num_rows() > 0) {
                  $sn = 0;

                  $total_dpt_amount = 0;
                  foreach ($fetch_pending_deposit->result() as $row) {
                    $sn++;
                    $dpt_username = $row->dpt_username;
                    $dpt_id = $row->dpt_id;
                    $dpt_user_id = $row->dpt_user_id; // user_id=depositor's id
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
                    $dpt_date = $row->dpt_date;
                    $dpt_wallet_id = $row->dpt_wallet_id;
                    $dpt_txn_tracking_id=$row->dpt_txn_tracking_id;
                ?>

                    <tr>
                      <td class="text-right"><?= $sn ?></td>
                      <td><?= $dpt_username ?></td>
                      <td><?= $dpt_wallet_name . " | " . $dpt_wallet_address ?><br>Txn|Ref. id: <?= $dpt_txn_tracking_id ?>
                      </td>
                      <td class="text-right">$<?= $dpt_amount ?></td>
                      <td><?= $dpt_date ?></td>
                      <td><button class="btn-details btn p-0 btn-sm btn-block btn-success" dpt_user_id="<?= $dpt_user_id ?>" dpt_wallet_id="<?= $dpt_wallet_id ?>" dpt_amount="<?= $dpt_amount ?>" dpt_username="<?= $dpt_username ?>" dpt_wallet_address="<?= $dpt_wallet_address ?>" dpt_wallet_name="<?= $dpt_wallet_name ?>" dpt_id="<?= $dpt_id ?>" dpt_pkg_interest_rate="<?= $dpt_pkg_interest_rate ?>" dpt_date="<?= $dpt_date ?>" dpt_pkg_due_day="<?= $dpt_pkg_due_day ?>" data-toggle="modal" data-target="#manual-pay"><i class=" mdi mdi-skew-more"></i>Details</button></td>

                    </tr>
                
                
<script>
  $(document).ready(function() {
                   // show details once the deposit details modal is called
    $(".btn-details").click(function() {
      var dpt_user_id = $(this).attr("dpt_user_id");
      var dpt_date = $(this).attr("dpt_date");
      var dpt_pkg_interest_rate = $(this).attr("dpt_pkg_interest_rate");
      var dpt_pkg_due_day = $(this).attr("dpt_pkg_due_day");
      var dpt_amount = $(this).attr("dpt_amount");
      var dpt_username = $(this).attr("dpt_username");
      var dpt_wallet_address = $(this).attr("dpt_wallet_address");
      var dpt_wallet_name = $(this).attr("dpt_wallet_name");
      var dpt_id = $(this).attr("dpt_id"); // dbt_id=txn_id
      var dpt_wallet_id = $(this).attr("dpt_wallet_id");


      if (dpt_pkg_due_day > 1) {
        $("#show-plan").html(dpt_pkg_interest_rate + "% after " + dpt_pkg_due_day + " days");
      } else {
        $("#show-plan").html(dpt_pkg_interest_rate + "% after " + dpt_pkg_due_day + " day");
      }
      $("#show-username").html(dpt_username);
      $("#show-payment-system").html(dpt_wallet_name);
      $("#show-payee-wallet-address").html(dpt_wallet_address);
      $("#show-amount").html('$' + dpt_amount);
      $("#show-date").html(dpt_date);

      $("#crypto-id").val(dpt_wallet_id);
      $("#txn-id").val(dpt_id);
      $("#txn-amount").val(dpt_amount);
      $("#depositor-id").val(dpt_user_id);
    });
    // end of show details once the deposit details modal is called

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
                      if (isset($total_dpt_amount)) {
                        echo '<tr><td colspan="5">Total request amount: <span class="text-success h6">$' . $total_dpt_amount . '</span></td></tr>';
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

  <!-- deposit detail modal -->

  <!-- Modal -->
  <div class="modal fade" data-backdrop="static" id="manual-pay" role="dialog">

    <div class=" modal-dialog modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Depost details</h4>
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
                <td class="text-right">Deposit amount: </td>
                <td id="show-amount" class="text-primary"></td>
              </tr>
              <tr>
              <tr>
                <td class="text-right">Dep. Username: </td>
                <td id="show-username" class="text-primary"></td>
              </tr>
              <tr>
                <td class="text-right">Cryptocurrency: </td>
                <td id="show-payment-system" class="text-primary"></td>
              </tr>

              <tr>
                <td class="text-right">Depositors<br> wallet id: </td>
                <td><textarea readonly class="form-control border-0 bg-light text-primary p-0" id="show-payee-wallet-address"></textarea></td>
              </tr>
              <tr>
                <td class="text-right">Selected plan: </td>
                <td id="show-plan" class="text-primary"></td>
              </tr>


              <tr>
                <td class="text-right">Txn. date: </td>
                <td id="show-date" class="text-primary"></td>
              </tr>
              <td colspan="2" class="text-center">

                <input id="txn-id" readonly type="hidden" class="form-control">
                <input id="depositor-id" readonly type="hidden" class="form-control">
                <input id="txn-amount" readonly type="hidden" class="form-control">
                <input id="crypto-id" readonly type="hidden" class="form-control">

                <button id="confirm-txn" class="btn btn-success btn-sm m-1">Confirm deposit</button>
                <button id="query-txn" class="btn btn-warning btn-sm m-1">Query deposit</button>
                <button id="delete-txn" class="btn btn-danger btn-sm m-1">Delete deposit</button>
                <p id="deposit-action-response"></p>
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

  <!-- end of deposit details modal -->

</body>


<script>
  $(document).ready(function() {

    // delete txn
    $("#delete-txn").click(function() {

      var depositorId = $("#depositor-id").val();
      var txnId = $("#txn-id").val(); // where txn id is the deposit id in the deposit table
      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

      Swal.fire({
        title: '<h5>Delete transaction from the list?</h5>',
        // text: 'Are you sure you want to carry out this action?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        icon: 'info'
      }).then((result) => {
        if (result.isConfirmed) {

          $('#deposit-action-response').html("<i>processing please wait..</i>")
          $.ajax({

            url: "<?php echo base_url('txn_pending_deposit/deleteTxn'); ?>",
            method: 'POST',
            data: {
              depositorId: depositorId,
              txnId: txnId,
              <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
            },
            success: function(data) {
              $("#deposit-action-response").html(data);
            }
          });
        }
      });


    });
    // end of delete txn


    // query txn
    $("#query-txn").click(function() {

      var depositorId = $("#depositor-id").val();
      var txnId = $("#txn-id").val(); // where txn id is the deposit id in the deposit table
      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

      Swal.fire({
        title: '<h5>Move transaction to query list?</h5>',
        // text: 'Are you sure you want to carry out this action?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        icon: 'info'
      }).then((result) => {
        if (result.isConfirmed) {

          $('#deposit-action-response').html("<i>processing please wait..</i>")
          $.ajax({

            url: "<?php echo base_url('txn_pending_deposit/queryTxn'); ?>",
            method: 'POST',
            data: {
              depositorId: depositorId,
              txnId: txnId,
              <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
            },
            success: function(data) {
              $("#deposit-action-response").html(data);
            }
          });

        }
      });

    });
    // end of query txn


    // confirm txn
    $("#confirm-txn").click(function() {
      var initialDeposit = $("#txn-amount").val();
      var depositorId = $("#depositor-id").val();
      var cryptoId = $("#crypto-id").val();
      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
      var txnId = $("#txn-id").val(); // where txn id is the deposit id in the deposit table

      Swal.fire({
        title: '<h5>Confirm transaction and send referral bonus?</h5>',
        //text: 'Are you sure you want to carry out this action?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        icon: 'info'
      }).then((result) => {
        if (result.isConfirmed) {

          $('#deposit-action-response').html("<i>processing please wait..</i>")
          $.ajax({

            url: "<?php echo base_url('txn_pending_deposit/approveTxn'); ?>",
            method: 'POST',
            data: {
              cryptoId: cryptoId,
              initialDeposit: initialDeposit,
              depositorId: depositorId,
              txnId: txnId,
              <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
            },
            success: function(data) {
              $("#deposit-action-response").html(data);
            }
          });


        }
      });
    });
    // end of confirm txn


  });
</script>

</html>