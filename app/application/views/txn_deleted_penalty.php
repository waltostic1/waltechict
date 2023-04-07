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

        <td style="min-width:200px;width:200px;vertical-align: top;">

          <?php $this->load->view('txn_nav.php') ?>
        </td>
        <td style="vertical-align: top;">
          <div class="bg-light p-2">

            <style>
              table #my-table tbody tr td {
                padding: 5px !important;
              }
            </style>

            <table id="my-table" class="display table nowrap table-striped table-bordered ">
              <h4 class="p-3">Deleted penalties</h4>
              <thead class="">
                <tr>
                  <th class="text-right">#</th>
                  <th>Username</th>
                  <th class="text-right text-success">Amount</th>
                  <th>Wallet</th>
                  <th>User wallet address</th>
                  <!-- <th>Company's wallet address</th> -->
                  <th>Comment | reason</th>
                  <th>Date</th>
                 </tr>
              </thead>
              <tbody>


                <?php
                if ($fetch_deleted_penalty->num_rows() > 0) {
                  $total_amount = $amount = $sn = 0;
                  foreach ($fetch_deleted_penalty->result() as $row) {
                    $sn++;
                    $pen_id = $row->pen_id;
                    $pen_user_id = $row->pen_user_id;
                    $pen_username = $row->pen_username;
                    $pen_amount = $row->pen_amount;
                    $pen_wallet_id = $row->pen_wallet_id;
                    $pen_wallet_name = $row->pen_wallet_name;
                    $pen_user_wallet_address = $row->pen_user_wallet_address;
                    $pen_company_wallet_address = $row->pen_company_wallet_address;
                    $pen_comment = $row->pen_comment;
                    $pen_date = $row->pen_date;
                    $total_amount = $total_amount + $pen_amount;
                ?>

                    <tr>
                      <td class="text-right"><?= $sn ?></td>
                      <td><?= $pen_username ?></td>
                      <td class="text-right text-success">$<?= number_format($pen_amount, 2); ?></td>
                      <td><?= $pen_wallet_name ?></td>
                      <td><?= $pen_user_wallet_address ?></td>
                      <!-- <td><?= $pen_company_wallet_address ?></td> -->
                      <td><?= $pen_comment ?><div id="resolve-action-div-<?=$pen_id?>"></div></td>
                      <td><?= substr($pen_date,0,10) ?></td>
                    </tr>

                <?php
                  }
                } else {
                  $report = "<tr> <td colspan='9' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
                }

                ?>

              </tbody>
              <tfoot>
                <?php
                if (isset($total_amount)) {
                  echo '<tr><td colspan="5">Total amount: <span class="text-success h6">$' . number_format($total_amount, 2) . '</span></td></tr>';
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