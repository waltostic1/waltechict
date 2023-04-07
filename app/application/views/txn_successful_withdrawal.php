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
            <h4 class="p-3">Successful | settled withdrawal</h4>
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th class="text-right text-success">Amount</th>
                  <th>Wallet | wallet address | comment</th>  
                  <th>Tracking id</th>                
                  <th>Date</th>
                  <!-- <th>Action </th> -->
                </tr>
              </thead>
              <tbody>


                <?php
                if ($fetch_successful_withdrawal->num_rows() > 0) {
                  $total_wd_amount = $sn = 0;

                  $total_dpt_amount = 0;
                  foreach ($fetch_successful_withdrawal->result() as $row) {
                    $sn++;
                    $wd_id = $row->wd_id;
                    $wd_username = $row->wd_username;
                    $wd_user_wallet_name = $row->wd_user_wallet_name;
                    $wd_user_wallet_address = $row->wd_user_wallet_address;
                    $wd_amount = $row->wd_amount;
                    $wd_status = $row->wd_status;
                    $wd_date = $row->wd_date;
                    $wd_tracking_id=$row->wd_tracking_id;
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
                      <td class="text-right text-success">$<?= number_format($wd_amount,2) ?></td>
                      <td><?= $wd_user_wallet_name . " | " . $wd_user_wallet_address ?></td>
                      <td><?= $wd_tracking_id ?></td>
                      <td><?= $wd_date ?></td>
                      <!-- <td><button class="btn-manual-pay btn p-0 btn-sm btn-block btn-success" wd_amount="<?= $wd_amount ?>" wd_username="<?= $wd_username ?>" wd_user_wallet_address="<?= $wd_user_wallet_address ?>" wd_user_wallet_name="<?= $wd_user_wallet_name ?>" wd_id="<?= $wd_id ?>" data-toggle="modal" data-target="#manual-pay"><i class=" mdi mdi-check"></i>Manual pay</button></td> -->

                    </tr>

                <?php
                  }
                } else {
                  $report = "<tr> <td colspan='6' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
                }

                ?>

              </tbody>
              <tfoot><?php
                      if (isset($total_wd_amount)) {
                        echo '<tr><td colspan="5">Total amount: <span class="text-success h6">$' . $total_wd_amount . '</span></td></tr>';
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