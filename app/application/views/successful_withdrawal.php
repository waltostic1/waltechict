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
                <div class="content-wrapper my-4">
                    <div class="row">
                        <div class=" col-12 p-0 py-3">
                            <h4>Successful | completed withdrawal</h4>
                        </div>
                        <div class="">


                            <?php

                            if ($get_withdrawal->num_rows() > 0) {
                                $totalAmount = $sn = 0;
                                foreach ($get_withdrawal->result() as $row) {
                                    $sn++;
                                    $id = $row->wd_id;
                                    $amount = $row->wd_amount;
                                    $status = $row->wd_status;
                                    if ($status == 1) {
                                        $status = "<i class='text-success'>success</i>";
                                    }
                                    $user_wallet_address = $row->wd_user_wallet_address;
                                    $user_wallet_name = $row->wd_user_wallet_name;
                                    $date = $row->wd_date;
                                    $tracking_id = $row->wd_tracking_id;
                                    $withdrawal_swapping = "withdrawal";
                                    if ($tracking_id == "") {
                                        $withdrawal_swapping = "swapping";
                                        $tracking_id = "not available | swapping option";
                                    }
                                    $totalAmount = $totalAmount + $amount;

                            ?>




                            <p class="bg-light text-dark p-3" data-toggle="modal"
                                data-target="#withdrawal-info-<?= $id ?>">
                                <?php echo "Txn $sn: <span class='text-success '>$" . number_format($amount, 2) . "</span> credited to your <span class='text-primary'> $user_wallet_name </span>wallet on $date" ?>
                                <a class="btn btn-more btn-sm btn-primary" data-toggle="modal"
                                    data-target="#withdrawal-info-<?= $id ?>">txn. details</a>
                            </p>



                            <!-- withdrawal-info modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="withdrawal-info-<?= $id ?>" role="dialog">

                                <div class=" modal-dialog modal-md">
                                    <div class="modal-content bg-light text-dark">
                                    <?php
                       
                       $msg='
                        <div style=" background-color:white; color:black; padding:10px;">
                            <h5 style="background-color:black; color:#ffab00; text-align:center; padding:14px;">BitNitro
                                mining company</h5>
                            <div style="padding: 3px 14px 3px 14px">
                                <h5>Successful '. $withdrawal_swapping .' </h5>
                                <p>Hi '. $username.', you have successfully withdrawn
                                    <b>$'. number_format($amount, 2) . '</b> worth of
                                    <b>'. strtoupper($user_wallet_name) .'</b> from your account</p>
                                <p><b>Withdrawal Address:</b> <br>'. $user_wallet_address .'<br>
                                <b>Transaction:</b> <br>'.$id.'-'.rand(1000000000000, 9000000000000) .'<br>
                                <b>Tracking Id:</b> <br>'. $tracking_id .'<br>
                                <b>Withdrawal Date:</b><br><textarea class="form-control border-0 bg-light text-primary p-0">'.$date.'</textarea> </p>
                                <p><a href="'.base_url('/dashboard').'"style="background-color:#ffab00; font-weight:bolder; color:black; 
                                border-radius:4px; padding:8px;">Visit Your Dashboard</a></p>
                                <p>Don\'t recognize this activity? please <a href="'.base_url('/password_reset').'">reset your password</a> 
                                and contact customer support immediately.</p>
                                <p>Please check with the receiving platform or wallet as the transaction is already confirmed on the blockchain explorer.</p>
                                <p style="text-align:center;"><i>-- Please do not replay to this message --</i></p>
                            </div>
                        </div>
                        ';
                       
                        ?>

                                         <!-- Modal body -->
                                        <div class="modal-body">
                                        <?= $msg;?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end of withdrawal-info modal -->



                            <?php
                                }
                                echo "<p class=' p-4 text-light'>Total amount: <span class='h5 text-success'>$" . number_format($totalAmount, 2) . "</span><p>";
                            } else {
                                echo "<p class='h3 text-center p-4 my-5 col-12 bg-light text-dark'>Hmm! no record found.</p>";
                            }

                            ?>
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