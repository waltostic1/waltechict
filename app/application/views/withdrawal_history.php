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

                    <div class="row">
                        <div class="">
                            <h4 class="mt-3">Pending withdrawal</h4>
                            <p class="text-light">Wait patiently, your wallet will be credited within 24hrs</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-dark table-striped">
                                <thead class=" text-uppercase">
                                    <tr>
                                        <th>Sn</th>
                                        <th>Amt</th>
                                        <th>Wallet</th>
                                        <th>Wallet address</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <!-- <th class="alert-primary text-center">Action </th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    if ($get_withdrawal->num_rows() > 0) {
                                        $totalAmount = $sn = 0;
                                        foreach ($get_withdrawal->result() as $row) {
                                            $sn++;
                                            $id = $row->wd_id;
                                            $amount = $row->wd_amount;
                                            $status = $row->wd_status;
                                            if ($status == 0) {
                                                $status = "<i class='text-warning'>pending</i>";
                                            }
                                            $user_wallet_address = $row->wd_user_wallet_address;
                                            $user_wallet_name = $row->wd_user_wallet_name;
                                            $date = $row->wd_date;
                                            $totalAmount = $totalAmount + $amount;


                                    ?>

                                            <tr>
                                                <td><?= $sn ?></td>
                                                <td class="text-success">$<?= $amount ?></td>
                                                <td><?= $user_wallet_name ?></td>
                                                <td><?= $user_wallet_address ?></td>
                                                <td><?= $status ?></td>
                                                <td><?= $date ?></td>
                                                <!-- <td class="alert-primary text-center"><button id="<?//=$id?>" class=" btn-contact-support btn btn-primary btn-sm"><i class=" mdi mdi-contact-mail "></i>support <i class=" mdi mdi-phone-classic "></i></button></td> -->
                                            </tr>

                                    <?php
                                        }
                                        echo "<tr><td colspan='7' class=' h1 p-4 text-light'>Total amount: <span class='h5 text-success'>$" . $totalAmount . "</span></td></tr>";
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center h1 p-4'>Hmm! no record found.</td></tr>";
                                    }

                                    ?>

                                </tbody>
                            </table>

                            <script>
                                $(document).ready(function(){
                                    $(".btn-contact-support").click(function(){
                                       var txnId= $(this).attr('id')
                                        Swal.fire(txnId,"","success");
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