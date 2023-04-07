<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view('txn_head') ?>

</head>


<body>

  <div class="">


    <table class=" p-0" style="width: 100%; margin:auto">
      <tr>
        <td colspan="2">
          <?php $this->load->view('txn_header') ?>
        </td>
      </tr>
      <tr>

        <td style="width:200px;min-width:200px;vertical-align: top;">
          <?php $this->load->view('txn_nav.php') ?>
        </td>
        <td style="vertical-align: top;">
          <style>
            table #my-table tbody tr td {
              padding: 5px !important;
            }
          </style>
          <h5 class="px-3">Information | transaction summary</h5>
          <div class="col-12 " style="font-size: 13px !important; ;">

            <p class="m-1">Total members:<span class="text-primary"><?= $fetch_users->num_rows(); ?></span>;
              Active members:<span class="text-primary"><?= $fetch_active_users->num_rows(); ?></span>;
              Inactive members:<span class="text-primary"><?= $fetch_inactive_users->num_rows(); ?></span>;
              Suspended members:<span class="text-primary"><?= $fetch_suspended_users->num_rows(); ?></span>
            </p>
            <p class="m-1">Members that have made deposit:<span class="text-primary"><?= $fetch_have_made_deposit_users->num_rows(); ?></span>;
              Members that have not made deposit:<span class="text-primary"><?= $fetch_have_not_made_deposit_users->num_rows(); ?></span>
            </p>

            <p class="m-1">Investment packages:<span class="text-primary"><?= $fetch_package->num_rows(); ?></span>;
              Wallets | cryptocurrencies:<span class="text-primary"><?= $fetch_cryptocurrency->num_rows(); ?></span>
            </p>
            <hr>

            <?php

            $deletedDeposit = $totalDeposit = $pendingDeposit = $quriedDeposit = $successfulDeposit = 0;
            foreach ($fetch_all_deposit->result() as $row) {
              $totalDeposit = $totalDeposit + $row->dpt_amount;
            }

            foreach ($fetch_successful_deposit->result() as $row) {
              $successfulDeposit = $successfulDeposit + $row->dpt_amount;
            }
            foreach ($fetch_pending_deposit->result() as $row) {
              $pendingDeposit = $pendingDeposit + $row->dpt_amount;
            }
            foreach ($fetch_queried_deposit->result() as $row) {
              $quriedDeposit = $quriedDeposit + $row->dpt_amount;
            }
            foreach ($fetch_deleted_deposit->result() as $row) {
              $deletedDeposit = $deletedDeposit + $row->dpt_amount;
            }

            $totalSysToken=$totalWithdrawal = $pendingWithdrawal = $successfullWithdrawal = $refBonus = 0;
            foreach ($fetch_all_withdrawal->result() as $row) {
              $totalWithdrawal = $totalWithdrawal + $row->wd_amount;
            }

            foreach ($fetch_successful_withdrawal->result() as $row) {
              $successfullWithdrawal = $successfullWithdrawal + $row->wd_amount;
            }
            foreach ($fetch_pending_withdrawal->result() as $row) {
              $pendingWithdrawal = $pendingWithdrawal + $row->wd_amount;
            }
            foreach ($fetch_all_ref_bonus->result() as $row) {
              $refBonus = $refBonus + $row->rr_bonus;
            }
            foreach ($fetch_users->result() as $row) {
              $totalSysToken = $totalSysToken + $row->total_amount;
            }

            ?>
            <p class="m-1">Total deposit:<span class="text-primary"><?= "$" . number_format($totalDeposit, 2) ?></span>;
              Confirmed deposit:<span class="text-success"><?= "$" . number_format($successfulDeposit, 2); ?></span>;
              Pending deposit:<span class="text-info"><?= "$" . number_format($pendingDeposit, 2); ?></span>;
              Quired deposit:<span class="text-warning"><?= "$" . number_format($quriedDeposit, 2) ?></span>;
              Deleted deposit:<span class="text-danger"><?= "$" . number_format($deletedDeposit, 2) ?></span>;
            </p>

            <p class="m-1">Total withdrawal order:<span class="text-primary">$<?= number_format($totalWithdrawal, 2) ?></span>;
              Successful withdrawal:<span class="text-success">$<?= number_format($successfullWithdrawal, 2) ?></span>;
              Pending withdrawal:<span class="text-warning">$<?= number_format($pendingWithdrawal, 2) ?></span>
            </p>

            <p class="m-1">Total referral commission | bonus:<span class="text-primary">$<?= number_format($refBonus, 2) ?></span></p>
            <p class="m-1">Total Sys-Token in members account:<span class="text-primary">$<?= number_format($totalSysToken, 2) ?></span></p>
            <hr>
            <p class="m-1">Confirmed deposit:<span class="text-primary"><?= "$" . number_format($successfulDeposit, 2); ?></span>;
              Withdrawals:<span class="text-info">$<?= number_format($successfullWithdrawal, 2) ?></span>;
              Balance:<span class="text-success">$<?= number_format($successfulDeposit - $successfullWithdrawal, 2) ?></span>;
            </p>

          </div>
          <div id="info-data-response" class="bg-light p-2">

          </div>

          <div class="alert alert-warning"> Welcome to the HYIP Manager Admin Area!<br> You can see help messages on almost all pages of the admin area in this part.<br> <br> 
          You can see how many members are registered in the system on this page.<br> 
          
          System supports 3 types of users:<br>
          <ul>
            <li>Active users: These users can login to the members area and receive earnings.</li>
            <li>Suspended users: These users can login to the members area but will not receive any earnings.</li>
            <li>Disabled users: These users can not login to the members area and will not receive any earnings.</li>
          </ul> <br> User becomes active when registering and only administrator can change status of any registered user. 
          You can see how many users are active and disabled in the system at the top of this page. <br> <br> 
          Investment packages:<br> You can create unlimited sets of investment packages with any settings and payout options. 
          Also you can change status of any package. <br> "Total system earnings" is a difference between funds came from payment processings and all the withdrawals you made. <br> <br> "Total member's balance" shows you how many funds can users withdraw from the system. It is the sum of all users' earnings and bonuses minus penalties and withdrawals. <br> <br> "Total member's deposit" shows you how many funds have users ever deposited in your system. <br> <br> "Current members' deposit" shows the overall users' deposit. <br> <br> "Total withdrawals" shows you how many funds have you withdrawn to users' accounts. <br> <br> "Pending withdrawals" shows you how many funds users have requested to withdraw. <br> <br> In/out stats shows you how many funds users have entered in your system and how many funds have you withdrawn today, this week, this month, this year and total.
          </div>
        </td>


      </tr>
      <tr>
        <td colspan="2" class="bg-dark text-light p-2">copyright@bitnitro.com</td>
      </tr>
    </table>



    <?php $this->load->view('txn_script') ?>
  </div>


</body>

<script>
  // $(selected).load("url", "data", "callback") ({
  //   this();
  // });

  $(document).ready(function() {



    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
    $.ajax({
      url: "<?php echo base_url('txn_info/getInfo'); ?>",
      method: 'POST',
      data: {
        <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
      },
      success: function(data) {
        $("#info-data-response").html(data);
      }
    });

  });
</script>

</html>