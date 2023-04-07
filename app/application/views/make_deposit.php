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
<script>
    /* $(document).ready(function() {
    Swal.fire('Yes', 'no', 'info', 'icon');
  }); */
</script>

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
                                    <div class="card-header">
                                        <div class="align-items-center">
                                            <?php
                                            if ($status == '2') {
                                                echo "<h6 class='text-center text-danger py-2'>Sorry your account is on suspension, hence all transactions are disabled, contact support team for more info</h6>";
                                            } else if ($status == '0') {
                                                echo "<h6 class='text-center text-danger py-2 '>Sorry your account has been disabled, hence all transactions are disabled, contact support team for more info</h6>";
                                            }
                                            ?>
                                            <p class="mb-0 h5 text-dark ">Make deposit</p>
                                        </div>
                                    </div>


                                    <div class="card-body px-2 ">
                                        <p class="text-uppercase h6 text-sm mb-4 text-primary">Select any investment plan and make deposit</p>
                                        <div class="row my-3">

                                            <!-- get all package -->
                                            <?php if ($get_package->num_rows() > 0) {
                                                foreach ($get_package->result() as $row) {
                                                    $pkgId = $row->pkg_id;
                                                    $pkgName = $row->pkg_name;
                                                    $pkgStatus = $row->pkg_status;
                                                    $pkgMinAmount = $row->pkg_min_amount;
                                                    $pkgMaxAmount = $row->pkg_max_amount;
                                                    $pkgMaxAmountLabel = $row->pkg_max_amount_label;
                                                    $pkgDueDay = $row->pkg_due_day;
                                                    $pkgPercentage = $row->pkg_percentage;
                                                    $pkgDueDay > 1 ? $surfix = "days" : $surfix = "day";

                                                    $crypto_Option = "";
                                                    $company_wallet_address = "";
                                                    foreach ($get_cryptocurrency->result() as $row1) {
                                                      	$crypto_status=$row1->c_status;
                                                        $crypto_id = $row1->c_id;
                                                        $crypto_name = $row1->c_name;
                                                        $crypto_table = $row1->c_table;
                                                        $crypto_creator_id = $row1->c_creator_id;
                                                        // $company_wallet_address = $company_wallet_address . '<div id="'.$pkgId.'-company-wallet-address-' . $crypto_id . '" class="all-wallet-address" >Transfer '.$crypto_name .' only to this <br>'.$crypto_name.' wallet address <p class="text-primary" style="font-size: 12px;"><br><u>'. $row1->c_admin_wallet_address . "</u></p></div>";
                                                        //$company_wallet_address = $company_wallet_address . '<div id="' . $pkgId . '-company-wallet-address-' . $crypto_id . '" class="all-wallet-address" >Transfer ' . $crypto_name . ' only to this <br>' . $crypto_name . ' wallet address. <br>Also ensure to make transfer through <br> wallet  registed with us <textarea class="wall-address text-primary form-control" style="font-size: 14px;">' . $row1->c_admin_wallet_address . "</textarea></div>";
                                                      if($crypto_status=='active'){
                                                        $company_wallet_address = $company_wallet_address . '<div id="' . $pkgId . '-company-wallet-address-' . $crypto_id . '" class="all-wallet-address" ><textarea class="form-control" style="background-color:#212529!important; color:#0078C1!important; border:none" readonly rows="4">Transfer ' . $crypto_name . ' only to this ' . $crypto_name . ' wallet address. Also ensure to make transfer through wallet  registed with us </textarea><textarea readonly class="wall-address text-primary form-control" style="font-size: 14px;">' . $row1->c_admin_wallet_address . "</textarea></div>";
                                                        $crypto_Option = $crypto_Option . "<option  value=" . $crypto_id . ">$crypto_name</option>";}
                                                    }

                                                    if ($pkgStatus == 'active') {
                                            ?>




                                                        <div class="col-md-6 ">


                                                            <div class="form-group bg-dark p-4">

                                                                <div class="table-responsive">
                                                                    <table class="table table-dark">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class=" text-uppercase text-light"><?= ($pkgName . " plan") ?> </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Amount</td>
                                                                                <td><input type="hidden" id="<?= $pkgName ?>-min-amount" value="<?= $pkgMinAmount ?>">
                                                                                    <input type="hidden" id="<?= $pkgName ?>-max-amount" value="<?= $pkgMaxAmount ?>">
                                                                                    <?= "$" . $pkgMinAmount . " - " . $pkgMaxAmountLabel ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Profit (%)</td>
                                                                                <td><?= $pkgPercentage . "% after " . $pkgDueDay . " " . $surfix ?></td>
                                                                            </tr>

                                                                            <tr>

                                                                                <td colspan="2">
                                                                                    <p>Enter amount ($) to invest</p>
                                                                                    <input data-cal-profit="<?= $pkgName ?>" data-pkg-percentage="<?= $pkgPercentage ?>" id="<?= $pkgName ?>-investment-amount" type="number" min="<?= $pkgMinAmount ?>" max="<?= $pkgMaxAmount ?>" class=" i-a-input form-control" placeholder="Enter amount to invest (eg:<?= $pkgMaxAmount ?>)">
                                                                                    <div id="show-profit-<?= $pkgName ?>" class="pt-3 text-right"></div>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>

                                                                                <td colspan="2">
                                                                                    <p>Select cryptocurrency to make deposit</p>
                                                                                    <select class="form-control wallet-select" id="<?= $pkgName ?>" data-pkg-id="<?= $pkgId ?>">
                                                                                        <option value="">Select..</option>
                                                                                        <option value="system_wallet">Pay from Sys-Token balance</option>
                                                                                        <?= $crypto_Option ?>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2">
                                                                                    <?= $company_wallet_address ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2">
                                                                                    
                                                                                    <div id="tracking-id-div<?=$pkgName?>">
                                                                                    <p>Make transfer, enter the transaction | tracking id, and click deposit . </p>
                                                                                    <input required type="text" name="tracking_id" id="tracking-id<?=$pkgName?>" class="form-control" placeholder="Enter transaction | tracking id ">
                                                                                    </div>
                                                                                    <br> I have made the deposit <i class="mdi mdi-arrow-right mdi-18px"></i>
                                                                                    <button class="btn-done btn btn-primary" data-pkg-due-day="<?= $pkgDueDay ?>" data-pkg-percent="<?= $pkgPercentage ?>" data-pkg-name="<?= $pkgName ?>" data-pkg-id-btn="<?= $pkgId ?>" id="btn-done<?= $pkgName ?>">Deposit</button>
                                                                                    <p id="deposit-response-<?= $pkgName ?>"></p>
                                                                                </td>
                                                                            </tr>
                                                                           
                                                                        </tbody>
                                                                    </table>
                                                                </div>


                                                            </div>


                                                        </div>

                                            <?php
                                                    } else {
                                                    }
                                                }
                                            } ?>

                                            <!-- end get all cryptocurrency and user address -->


                                            <script>
                                                $(document).ready(function() {

                                                    <?php
                                                    // enable the deposit cmd if status is 1 (active)
                                                    if ($status == '1') {

                                                    ?>

                                                        // deposit cmd
                                                        $('.btn-done').click(function() {
                                                            pkgName = $(this).attr('data-pkg-name');
                                                            pkgId = $(this).attr('data-pkg-id-btn');
                                                            pkgDueDay = $(this).attr('data-pkg-due-day');
                                                            depositAmount = parseInt($('#' + pkgName + '-investment-amount').val());
                                                            depositAmount2 = ($('#' + pkgName + '-investment-amount').val());
                                                            pkgPercentage = $(this).attr('data-pkg-percent');
                                                            walletId = $('#' + pkgName).val();
                                                            minAmount = parseInt($("#" + pkgName + "-min-amount").val());
                                                            maxAmount = parseInt($("#" + pkgName + "-max-amount").val());
                                                            tracking_id=$('#tracking-id' + pkgName).val();
                                                            
                                                            //alert(minAmount +" Max:"+ maxAmount +" Deposit:"+depositAmount);//return;
                                                            var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                                                            //system_wallet
                                                            if (walletId == "system_wallet") {
                                                                msg1 = '$' + depositAmount2 + " will be deducted from your Sys-Token balance";
                                                                msg2 = "do you want to continue?";
                                                            } else {
                                                                msg1 = "Make transfer before clicking the deposit button";
                                                                msg2 = "Have you made the transfer?";
                                                            }
                                                            Swal.fire({
                                                                title: '<h5>' + msg1 + '</h5>',
                                                                text: '' + msg2 + '',
                                                                showDenyButton: true,
                                                                confirmButtonText: 'Yes',
                                                                denyButtonText: 'No',
                                                                icon: 'info'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {


                                                                    if (depositAmount < minAmount || depositAmount > maxAmount) {
                                                                        Swal.fire("Deposit amount is out of range", "please edit and try again.", "error")
                                                                        return;
                                                                    }
                                                                    if (depositAmount < 1 || depositAmount2 == "") {
                                                                        Swal.fire("Invalid investment amount!", "please edit and try again.", "error")
                                                                        return;
                                                                    }
                                                                    if (walletId == '') {
                                                                        Swal.fire("Invalid cryptocurrency!", "please select cryptocurrency and try again.", "error")
                                                                        return;
                                                                    }
                                                                    if (tracking_id == '') {
                                                                        Swal.fire("Invalid transaction id!", "please enter transaction id and try again.", "error")
                                                                        return;
                                                                    }

                                                                    $.ajax({

                                                                        url: "<?php echo base_url('make_deposit/deposit'); ?>",
                                                                        method: 'POST',
                                                                        data: {
                                                                            pkgDueDay: pkgDueDay,
                                                                            pkgName: pkgName,
                                                                            pkgId: pkgId,
                                                                            depositAmount: depositAmount,
                                                                            walletId: walletId,
                                                                            pkgPercentage: pkgPercentage,
                                                                            tracking_id:tracking_id,
                                                                            <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                                                                        },
                                                                        success: function(data) {
                                                                            $("#deposit-response-" + pkgName).html(data);
                                                                        }
                                                                    });


                                                                }
                                                            })

                                                        });
                                                        // end of done|deposit function
                                                    <?php } ?>


                                                    // copy wallet address function
                                                    $(".wall-address").click(function() {
                                                        var copyText = $(this).val();
                                                        $(this).select();
                                                        document.execCommand('copy');
                                                        Swal.fire('Wallet address copied', copyText, 'success');
                                                    });


                                                    // calculate interest
                                                    $(".i-a-input").change(function() {
                                                        var s = $(this).attr('data-cal-profit');
                                                        var setPercentage = parseInt($(this).attr('data-pkg-percentage'));
                                                        var amount = parseInt($(this).val());
                                                        var interest = (setPercentage / 100) * amount;
                                                        //interest=interest.toFixed(2);
                                                        var total = amount + interest;
                                                        $('#show-profit-' + s).html("Amount: $" + amount + "<br>Profit: $" + interest.toFixed(2) + "<br>Total: $" + total.toFixed(2));

                                                    });
                                                    $(".i-a-input").keyup(function() {
                                                        var s = $(this).attr('data-cal-profit');
                                                        var setPercentage = parseInt($(this).attr('data-pkg-percentage'));
                                                        var amount = parseInt($(this).val());
                                                        var interest = (setPercentage / 100) * amount;
                                                        //interest=interest.toFixed(2);
                                                        var total = amount + interest;
                                                        $('#show-profit-' + s).html("Amount: $" + amount + "<br>Profit: $" + interest.toFixed(2) + "<br>Total: $" + total.toFixed(2));

                                                    });




                                                    $(".all-wallet-address").hide();
                                                    $('.wallet-select').change(function() {
                                                        var selectedId = $(this).attr('id');
                                                        var selectedPackageName = $(this).attr('data-pkg-id');
                                                        var selectedCryptoId = $('#' + selectedId).val();
                                                        //alert(selectedPackageName);
                                                        $(".all-wallet-address").hide();
                                                        $('#' + selectedPackageName + '-company-wallet-address-' + selectedCryptoId).show('1000');

                                                        if($(this).val()==="system_wallet"){
                                                            $('#tracking-id' + selectedId).val('system_wallet');
                                                            $('#tracking-id-div' + selectedId).hide();
                                                            
                                                        }else{
                                                            $('#tracking-id-div' + selectedId).show();
                                                            $('#tracking-id' + selectedId).val('');
                                                        }
                                                        
                                                       

                                                    });


                                                });
                                            </script>

                                        </div>


                                    </div>

                                </div>
                            </div>


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
    <script>
        $(document).ready(function() {


        });
    </script>
</body>

</html>