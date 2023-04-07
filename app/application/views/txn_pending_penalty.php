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
              <h4 class="p-3">Pending penalties | defaulters who claimed to have paid</h4>
              <thead class="">
                <tr>
                  <th class="text-right">#</th>
                  <th>Username</th>
                  <th class="text-right text-success">Amount</th>
                  <th>Wallet</th>
                  <th>Sender's wallet address</th>
                  <!-- <th>Company's wallet address</th> -->
                  <th>Comment | reason</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>


                <?php
                if ($fetch_pending_penalty->num_rows() > 0) {
                  $total_amount = $amount = $sn = 0;
                  foreach ($fetch_pending_penalty->result() as $row) {
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
                      <td class="text-center ">
                        <button class="resolve-button btn btn-sm btn-link" id="resolve" data-pen-user-id="<?= $pen_user_id ?>" data-pen-id="<?= $pen_id ?>"><u>resolve</u></button>
                        
                    </td>
                    </tr>
                
                <script>
  $(document).ready(function() {
    //resolve action
    $(".resolve-button").click(function() {

      var penaltyId=$(this).attr('data-pen-id');
      var penaltyUserId=$(this).attr('data-pen-user-id');
      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

      Swal.fire({
        title: '<h3>Resolve penalty issue?</h3>',
        text: 'Note: action cannot be undone if you click yes, are you sure you want to perform this action?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        icon: 'info'
      }).then((result) => {
        if (result.isConfirmed) {

          $('#resolve-action-div-'+penaltyId).html("<br><small><i>please wait...</i></small>");
          $.ajax({
            url: "<?php echo base_url('txn_pending_penalty/resolve'); ?>",
            method: 'POST',
            data: {
              txnId: penaltyId,
              penaltyUserId:penaltyUserId,
              <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
            },
            success: function(data) {
              $("#resolve-action-div-"+penaltyId).html(data);
            }
          });

        }
      });

    });
    // end of resolve action

  });
</script>

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




</html>