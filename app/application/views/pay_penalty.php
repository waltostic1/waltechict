<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("head.php");
$this->load->view("script.php");

if ($get_user_info->num_rows() > 0) {
  $userId = $this->session->userdata('user_id');
  foreach ($get_user_info->result() as $row) {

    $username = $row->username;
    $fullName = $row->full_name;
    $email = $row->email;
    $phone = $row->phone;
    $upliner = $row->ref_username;
    $status = $row->status;
    $loginToken = $row->login_token;
    $photo = $row->photo;
    $totalAmount = $row->total_amount;
  }
}
?>

<body>

  <div class="container-scroller">

    <!-- sidebar -->
    <?php $this->load->view("sidebar.php"); ?>
    <!-- end of sidebar -->

    <div class="container-fluid page-body-wrapper">

      <!-- navbar -->
      <?php $this->load->view("navbar") ?>
      <!-- end of navbar -->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="container-fluid ">
            <div class="row">


              <div class="col-12 p-0 my-4">



                <div class="card bg-light">


                  <?php
                  if ($fetch_penalty->num_rows() > 0) {
                    $amount = $sn = 0;
                    $pen_crypto_Option= $crypto_Option = "";
                    foreach ($fetch_penalty->result() as $row) {
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
                      $pen_status=$row->pen_status;
                      $pen_crypto_Option = "<option wallet-name='$pen_wallet_name' wallet-id='$pen_wallet_id'  value=" . $pen_company_wallet_address . ">$pen_wallet_name</option>";


                      // get tbl_cryptocurrency
                      foreach ($get_cryptocurrency->result() as $row1) {
                        $crypto_id = $row1->c_id;
                        $crypto_name = $row1->c_name;
                        $crypto_table = $row1->c_table;
                        $crypto_creator_id = $row1->c_creator_id;
                        $company_wallet_address = $row1->c_admin_wallet_address;                        
                        $crypto_Option = $crypto_Option . "<option wallet-name='$crypto_name' wallet-id='$crypto_id'  value=" . $company_wallet_address . ">$crypto_name</option>";
                      }

                  ?>

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <p class="mb-0 h6 text-dark ">You have been penalized & restricted from placing withdrawals. Pay the order below to remove this restriction </p>
                        </div>
                      </div>

                      <div class="card-body px-2 text-light table-dark">
                        <p class=" ">Penalty order of <span class="text-primary">$<?= number_format($pen_amount, 2) ?></span> created on <span class="text-primary "><?= $pen_date ?></span></p>
                        <p class="">Amount to pay: <span class="text-primary">$<?= number_format($pen_amount, 2) ?></span></p>
                        <p class="">Reason: <span class="text-primary"><?= $pen_comment ?></span></p>
                        <p>You can pay to any of the company's wallet account | address</p>

                        <div class="form-group mt-4">
                          <label for="">Select payment method</label>
                          <select class="form-control" id="payment-method">
                            <?=!$pen_status==""?$pen_crypto_Option:""?>
                            <option value="">Select...</option>
                            <?=$crypto_Option?>                                                                                 
                          </select>
                          <div id="show-company-wallet-address"></div>
                        </div>

                        <div class="form-group mt-4">
                          <label for="user-wallet-address">Enter your wallet address used in making the payment</label>
                          <input type="text" name="" id="user-wallet-address" class="form-control" <?=!$pen_user_wallet_address==""?"value='$pen_user_wallet_address'":""?> placeholder="Enter your wallet address">
                        </div>
                        <div class="form-group mt-4">
                          <label for="">If you have made the payment, click the <u>i have made the payment</u> button</label>
                          <div class=" container col-12 col-md-6">
                            
                            <button class="btn btn-primary btn-block" data-pen-id="<?= $pen_id ?>" id="btn-paid">I have made the payment</button>
                            <p class=" text-center text-muted mt-3" id="paid-action-response"></p>
                          </div>


                        </div>

                    <?php }
                  } else {
                    echo "<h4 class='text-center text-success my-4'>Congratulations, you have no penalty order</h4>";
                  } ?>

                      </div>
                </div>

                <script>
                  $(document).ready(function() {
                    $("#payment-method").change(function() {
                      $("#show-company-wallet-address").html("Please make payment of <span class='text-primary'>$<?= number_format($pen_amount, 2) ?></span> to the company's wallet address below<br><span class='text-primary'>" + $(this).val() + "</span>");
                    });


                    $("#btn-paid").click(function() {
                      var wallet_name = $("#payment-method").find('option:selected').attr('wallet-name');
                      var wallet_id = $("#payment-method option:selected").attr('wallet-id');
                      var user_wallet_address = $("#user-wallet-address").val();
                      var company_wallet_address = $("#payment-method").val();
                      var pen_id = $(this).attr("data-pen-id");
                      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                      if (company_wallet_address == "") {
                        Swal.fire("Invalid payment method", "Please select a payment method", "error");
                        return;
                      }
                      if (user_wallet_address == "") {
                        Swal.fire("Invalid wallet id", "Please enter your wallet id", "error");
                        return;
                      }

                      // Swal.fire(username,"",'success');return;
                      Swal.fire({
                        title: '<h5>Please make payment before proceeding</h5>',
                        text: 'Are you sure you have paid the order?',
                        showDenyButton: true,
                        confirmButtonText: 'Yes',
                        denyButtonText: 'No',
                        icon: 'info'
                      }).then((result) => {
                        if (result.isConfirmed) {

                          $("#paid-action-response").html("<i>processing...</i>");

                          $.ajax({

                            url: "<?php echo base_url('pay_penalty/pay_penalty'); ?>",
                            method: 'POST',
                            data: {
                              wallet_name: wallet_name,
                              wallet_id: wallet_id,
                              pen_id: pen_id,
                              user_wallet_address: user_wallet_address,
                              company_wallet_address: company_wallet_address,
                              <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                            },
                            success: function(data) {
                              $("#paid-action-response").html(data);
                            }
                          });


                        }
                      });

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