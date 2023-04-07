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
            <h4 class="p-3">Successful | confirmed | completed deposit</h4>
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Wallet | Wallet address</th>
                  <th class="text-right">Amount</th>
                  <th>Date</th>
                  <!-- <th>Action </th> -->
                </tr>
              </thead>
              <tbody>


                <?php
                if ($fetch_successful_deposit->num_rows() > 0) {
                  $sn = 0;

                  $total_dpt_amount = 0;
                  foreach ($fetch_successful_deposit->result() as $row) {
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
                      <td><?= $dpt_wallet_name . " | " . $dpt_wallet_address ?><br>Txn|Ref. id: <?= $dpt_txn_tracking_id ?></td>
                      <td class="text-right">$<?= $dpt_amount ?></td>
                      <td><?= $dpt_date ?></td>
                      <!-- <td><button class="btn-details btn p-0 btn-sm btn-block btn-success" dpt_user_id="<?= $dpt_user_id ?>" dpt_wallet_id="<?= $dpt_wallet_id ?>" dpt_amount="<?= $dpt_amount ?>" dpt_username="<?= $dpt_username ?>" dpt_wallet_address="<?= $dpt_wallet_address ?>" dpt_wallet_name="<?= $dpt_wallet_name ?>" dpt_id="<?= $dpt_id ?>" dpt_pkg_interest_rate="<?= $dpt_pkg_interest_rate ?>" dpt_date="<?= $dpt_date ?>" dpt_pkg_due_day="<?= $dpt_pkg_due_day ?>" data-toggle="modal" data-target="#manual-pay"><i class=" mdi mdi-skew-more"></i>Details</button></td> -->

                    </tr>

                <?php
                  }
                } else {
                  $report = "<tr> <td colspan='6' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
                }

                ?>

              </tbody>
              <tfoot><?php
                      if (isset($total_dpt_amount)) {
                        echo '<tr><td colspan="5">Total amount: <span class="text-success h6">$' . $total_dpt_amount . '</span></td></tr>';
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

</body>


<script>
  $(document).ready(function() {



  });
</script>

</html>