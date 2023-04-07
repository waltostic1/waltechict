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
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 h5 text-dark ">Deposit history</p>
                                        </div>
                                    </div>



                                    <?php
                                    if ($get_deposit->num_rows() > 0) {
                                        $sn = 0;
                                        foreach ($get_deposit->result() as $row) {
                                            $sn++;
                                            $dpt_id = $row->dpt_id;
                                            $dpt_username = $row->dpt_username;
                                            $dpt_package_name = $row->dpt_package_name;
                                            $dpt_package_id = $row->dpt_package_id;
                                            $dpt_amount = $row->dpt_amount;
                                            $dpt_wallet_id = $row->dpt_wallet_id;
                                            $dpt_pkg_due_day = $row->dpt_pkg_due_day;
                                            $dpt_pkg_interest_rate = $row->dpt_pkg_interest_rate;
                                            $dpt_total_income = $row->dpt_total_income;
                                            $dpt_wallet_name = $row->dpt_wallet_name;
                                            $dpt_wallet_address = $row->dpt_wallet_address;
                                            $dpt_company_wallet_address = $row->dpt_company_wallet_address;
                                            $dpt_status = $row->dpt_status;
                                            $dpt_txn_tracking_id=$row->dpt_txn_tracking_id;
                                            $profit=($dpt_pkg_interest_rate*$dpt_amount)/100;
                                            if ($dpt_status == 1) {
                                                $status_report = "<i class='text-success'>approved</i><span id='statuse-report-$dpt_id'></span>";
                                            } else if ($dpt_status == 0) {
                                                $status_report = "<i class='text-warning'>waiting for approval</i>
                                                <button class='cancel-btn btn btn-sm btn-danger ml-2' id='" . $dpt_id . "'>Cancel txn</button>";
                                            } else if ($dpt_status == 2) {
                                                $status_report = "<i class='text-warning'>quired</i>
                                                <button class='cancel-btn btn btn-sm btn-danger ml-2' id='" . $dpt_id . "'>Delete txn</button>
                                                 or contact an agent via our chart box";
                                            } else if ($dpt_status == 3) {
                                                $status_report = "<i class='text-success'>settled</i>";
                                            } else if ($dpt_status == 4) {
                                                $status_report = "<i class='text-danger'>deleted</i>
                                            <button class='cancel-btn btn btn-sm btn-danger ml-2' id='" . $dpt_id . "'>Delete txn</button>
                                            or contact an agent via our chart box";
                                            } else {
                                                $status_report = "<i class=' text-muted'>unknown</i>
                                            <button class='cancel-btn btn btn-sm btn-danger ml-2' id='" . $dpt_id . "'>Delete txn</button>
                                            or contact an agent via our chart box";
                                            }
                                            $dpt_date = $row->dpt_date;
                                            $dpt_pkg_due_day > 1 ? $surfix = "days" : $surfix = "day";



                                    ?>


                                            <script>
                                                $(document).ready(function() {

                                                    var dptDate = new Date("<?= $dpt_date ?>"); // date of deposit
                                                    var dptPkgDueDay = <?= $dpt_pkg_due_day ?>; // no. of days txn to mature
                                                    var dbtNow = new Date();
                                                    var dbtDueDate = new Date(dptDate); // due date for cash out
                                                    dbtDueDate.setDate(dbtDueDate.getDate() + dptPkgDueDay);
                                                    var resp = "";
                                                    if (dbtDueDate.getTime() > dbtNow.getTime()) {
                                                        resp = "<i class='mx-3 text-warning'>not due for cash out</i>";
                                                      // if admin is loged in
                                                       <?php if ($this->session->userdata('admin_state') == "on") {
                                                        ?>
                                                            resp = "<button class='btn mx-3 btn-sm btn-success  mdi mdi-cash-100  cash-out-button' data-cash-out-id='<?= $dpt_id ?>' data-cash-out-amount='<?= $dpt_total_income ?>' dpt_id='<?= $dpt_id ?>'dpt_package_name ='<?= $dpt_package_name ?>' dpt_package_id='<?= $dpt_package_id ?>' dpt_amount='<?= $dpt_amount ?>' dpt_pkg_due_day='<?= $dpt_pkg_due_day ?>'dpt_pkg_due_day='<?= $dpt_pkg_due_day ?>' dpt_pkg_interest_rate='<?= $dpt_pkg_interest_rate ?>' dpt_total_income='<?= $dpt_total_income ?>' dpt_wallet_name='<?= $dpt_wallet_name ?>' dpt_wallet_address='<?= $dpt_wallet_address ?>' dpt_company_wallet_address='<?= $dpt_company_wallet_address ?>' dpt_status='<?= $dpt_status ?>' dpt_username='<?= $dpt_username ?>' dpt_wallet_id='<?= $dpt_wallet_id ?>' > Cash out $<?= $dpt_total_income ?></button>";

                                                        <?php
                                                        } ?>
                                                      // end of if admin is loged in

                                                                                                          //count down timer config

                                                    // Create a Date object for the starting date
                                                    var startDate = new Date("<?= $dpt_date ?>");
                                                    // Add 4 days to the starting date
                                                    startDate.setDate(startDate.getDate() + <?= $dpt_pkg_due_day ?>);
                                                    // Format the new date as a string
                                                    var newDateStr = startDate.toISOString().slice(0, 19).replace('T', ' ');                                                                                                      
                                                    
                                                    var targetDate = new Date(newDateStr);
                                                    var interval= setInterval(function() {
                                                    var diff = Math.floor((targetDate - new Date()) / 1000);

                                                    if (diff < 0) {     
                                                        return clearInterval(interval);                                                      
                                                    }
                                                                                                 
                                                    var days = Math.floor(diff / 86400);
                                                    diff -= days * 86400;
                                                    
                                                    var hours = Math.floor(diff / 3600) % 24;
                                                    diff -= hours * 3600;
                                                    
                                                    var minutes = Math.floor(diff / 60) % 60;
                                                    diff -= minutes * 60;
                                                    
                                                    var seconds = diff % 60;
                                                    
                                                    var timerText = days + "d " + hours + "h " + minutes + "m " + seconds + "s";
                                                    $(".timer<?=$dpt_id?>").html("Cash out time: <span class='h5 text-primary'>"+timerText+"</span>");
                                                    }, 1000);

                                                    // end of count down timer config


                                                    } else {
                                                        resp = "<button class='btn mx-3 btn-sm btn-success  mdi mdi-cash-100  cash-out-button' data-cash-out-id='<?= $dpt_id ?>' data-cash-out-amount='<?= $dpt_total_income ?>' dpt_id='<?= $dpt_id ?>'dpt_package_name ='<?= $dpt_package_name ?>' dpt_package_id='<?= $dpt_package_id ?>' dpt_amount='<?= $dpt_amount ?>' dpt_pkg_due_day='<?= $dpt_pkg_due_day ?>'dpt_pkg_due_day='<?= $dpt_pkg_due_day ?>' dpt_pkg_interest_rate='<?= $dpt_pkg_interest_rate ?>' dpt_total_income='<?= $dpt_total_income ?>' dpt_wallet_name='<?= $dpt_wallet_name ?>' dpt_wallet_address='<?= $dpt_wallet_address ?>' dpt_company_wallet_address='<?= $dpt_company_wallet_address ?>' dpt_status='<?= $dpt_status ?>' dpt_username='<?= $dpt_username ?>' dpt_wallet_id='<?= $dpt_wallet_id ?>' > Cash out $<?= $dpt_total_income ?></button>";
                                                    }

                                                    $("#statuse-report-" + "<?= $dpt_id ?>").html(resp);



                                                });
                                            </script>

                                            <div class="card-body px-2 ">

                                                <!-- <p class="text-uppercase h6 text-sm mb-4 text-primary">Select any investment plan and make deposit</p> -->
                                                <div class="table-responsive">
                                                    <table class="table table-dark">
                                                        <thead>
                                                            <tr>
                                                                <th class=" text-uppercase text-light"><span class="text-primary p-2 mx-2 h5 bg-light btn-icon rounded-circle"> <?= $sn ?> </span> <?= $dpt_package_name ?> plan <span class="float-right text-primary"><?= $dpt_date ?></span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    Amount transfered: <span class="text-primary h6">$<?= $dpt_amount ?></span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td> 
                                                                    <p>Profit(<?= $dpt_pkg_interest_rate ?>% after <?= $dpt_pkg_due_day . " " . $surfix ?>): <span class="text-primary h6"> $<?=$profit?> </span></p>
                                                                    
                                                                    <p class=" timer<?=$dpt_id?>" ></p>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    Income | cash out after <?= $dpt_pkg_due_day . " " . $surfix ?>: <span class="text-primary h6">$<?= $dpt_total_income ?></span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <p>Transfered from <?= $dpt_wallet_name ?>: <textarea readonly class="text-primary h5 form-control" style="background-color:#212529!important; color:#0078C1!important; border:none"><?= $dpt_wallet_address ?></textarea>
                                                                    <p>
                                                                    <p>Transfered to <?= $dpt_wallet_name ?>: <textarea readonly class="text-primary h5 form-control" style="background-color:#212529!important; color:#0078C1!important; border:none"><?= $dpt_company_wallet_address ?></textarea>
                                                                    <p>
                                                                    <p>Transaction | Tracking id : <textarea readonly class="text-primary h5 form-control" style="background-color:#212529!important; color:#0078C1!important; border:none"><?= $dpt_txn_tracking_id ?></textarea>
                                                                    <p>
                                                                    
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    Txn. status: <span class=""> <?= $status_report ?></span>
                                                                    <p id="cancel-txn-response-<?= $dpt_id ?>"></p>
                                                                    <p id="cash-out-txn-response-<?= $dpt_id ?>"></p>
                                                                    <p class=" timer<?=$dpt_id?>" ></p>
                                                                    
                                                                </td>
                                                            </tr>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                    <?php }
                                    } ?>

                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {                  

                                    $('.cash-out-button').click(function() {

                                        var txnId = $(this).attr('data-cash-out-id');
                                        var txnAmount = $(this).attr('data-cash-out-amount');
                                        var dpt_id = $(this).attr('dpt_id');
                                        var dpt_username = $(this).attr('dpt_username');
                                        var dpt_package_name = $(this).attr('dpt_package_name');
                                        var dpt_package_id = $(this).attr('dpt_package_id');
                                        var dpt_amount = $(this).attr('dpt_amount');
                                        var dpt_wallet_id = $(this).attr('dpt_wallet_id');
                                        var dpt_pkg_due_day = $(this).attr('dpt_pkg_due_day');
                                        var dpt_pkg_interest_rate = $(this).attr('dpt_pkg_interest_rate');
                                        var dpt_total_income = $(this).attr('dpt_total_income');
                                        var dpt_wallet_name = $(this).attr('dpt_wallet_name');
                                        var dpt_wallet_address = $(this).attr('dpt_wallet_address');
                                        var dpt_company_wallet_address = $(this).attr('dpt_company_wallet_address');
                                        var dpt_status = $(this).attr('dpt_status');

                                        var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

                                        //alert(dpt_company_wallet_address);return;



                                        $.ajax({

                                            url: "<?php echo base_url('deposit_history/cashOutTxn'); ?>",
                                            method: 'POST',
                                            data: {
                                                txnId: txnId,
                                                txnAmount: txnAmount,
                                                dpt_id: dpt_id,
                                                dpt_username: dpt_username,
                                                dpt_package_name: dpt_package_name,
                                                dpt_package_id: dpt_package_id,
                                                dpt_amount: dpt_amount,
                                                dpt_wallet_id: dpt_wallet_id,
                                                dpt_pkg_due_day: dpt_pkg_due_day,
                                                dpt_pkg_interest_rate: dpt_pkg_interest_rate,
                                                dpt_total_income: dpt_total_income,
                                                dpt_wallet_name: dpt_wallet_name,
                                                dpt_wallet_address: dpt_wallet_address,
                                                dpt_company_wallet_address: dpt_company_wallet_address,
                                                dpt_status: dpt_status,
                                                <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                                            },
                                            success: function(data) {
                                                $("#cash-out-txn-response-" + txnId).html(data);
                                            }
                                        });

                                    });


                                    $('.cancel-btn').click(function() {

                                        var txnId = $(this).attr('id');
                                        var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

                                        Swal.fire({
                                            title: '<h5>Your account will not be credited if you cancel this transaction.</h5>',
                                            text: 'Are you sure you want to cancel this transaction?',
                                            showDenyButton: true,
                                            confirmButtonText: 'Yes',
                                            denyButtonText: 'No',
                                            icon: 'info'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.ajax({

                                                    url: "<?php echo base_url('deposit_history/cancelTxn'); ?>",
                                                    method: 'POST',
                                                    data: {
                                                        txnId: txnId,
                                                        <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                                                    },
                                                    success: function(data) {
                                                        $("#cancel-txn-response-" + txnId).html(data);
                                                    }
                                                });

                                            }
                                        })

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