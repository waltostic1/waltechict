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

        <td style="min-width:200px; width:200px;vertical-align: top;">

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
              <h4 class="">Cryptocurrency | Wallet Address</h4>
              <p class="text-uppercase h6 text-sm mb-4 text-primary">Update company's Wallet address</p>
              <thead class="">
                <tr>
                  <th class="text-right">#</th>
                  <th>Cryptocurrency | wallet address</th>
                  <th>Enter company's wallet address<br>and click save button</th>
                  <th class="text-center">Save </th>
                </tr>
              </thead>
              <tbody>


                <!-- get all cryptocurrency and user address -->
                <?php if ($get_cryptocurrency->num_rows() > 0) {
                  $sn = 0;

                  foreach ($get_cryptocurrency->result() as $row) {
                    $sn++;
                    $cryptoId = $row->c_id;
                    $cryptoName = $row->c_name;
                    $cryptoTable = $row->c_table;
                    $walletAddress = $row->c_admin_wallet_address;

                ?>

                    <tr>
                      <td class="text-right"><?= $sn ?></td>
                      <td> <?= ($cryptoName . " address: ") ?><span id="response-wallet-<?= $cryptoId  ?>" class=" text-small text-primary text-decoration-underline"><?= $walletAddress ?></span></td>

                      <td class="m-0 p-0">
                        <!-- <label for="wallet-<?php echo $cryptoTable ?>" class="form-control-label">Enter <?php echo $cryptoName ?> wallet address</label> -->
                        <input class="form-control m-0" required id="wallet-<?= $cryptoId ?>" type="text" value="<?= $walletAddress ?>" placeholder="Enter <?= $cryptoName ?> wallet address">
                      </td>

                      <td class="text-left m-0">
                        <button type="submit" name="save" id="save-<?= $cryptoId ?>" data-cryptoId="<?= $cryptoId ?>" class="btn btn-primary m-0 mdi mdi-content-save"> Save <?//= $cryptoName ?></button>
                      </td>
                    </tr>
                
                
<script>
  $(document).ready(function() {

    // save user wallet address
    $('#save-<?= $cryptoId ?>').click(function() {
      var cryptoId = $(this).attr('data-cryptoId');
      var walletAddress = $('#wallet-' + cryptoId).val();
      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
      //alert(cryptoId);return
      $.ajax({

        url: "<?php echo base_url('txn_company_wallet_address/save_wallet'); ?>",
        method: 'POST',
        data: {
          cryptoId: cryptoId,
          walletAddress: walletAddress,
          <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
        },
        success: function(data) {
          $("#response-wallet-" + cryptoId).html(data);
        }
      });
    });

    // save user wallet address
  });
</script>

                <?php

                  }
                } else {
                  echo $report = "<tr> <td colspan='6' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
                }

                ?>

              </tbody>
              <tfoot>
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