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

        $this->session->set_userdata("sys_token",$totalAmount);
        
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
                           <?php 
                            if($status=='2'){
                                echo "<h6 class='text-center text-danger mt-2 py-2 '>Sorry your account is on suspension, hence all transactions are disabled, contact support team for more info</h6>";
                               
                            }else if($status=='0'){
                                echo "<h6 class='text-center text-danger mt-2 py-2 '>Sorry your account has been disabled, hence all transactions are disabled, contact support team for more info</h6>";
                               
                            }
                            ?>
                            <h4 class='mt-3'>Make withdrawal</h4><?php echo $this->session->userdata('admin_state')=="on"?"<span class='text-primary'>Admin can edit balance, and also place withdrawal order</span>":""?>
                            <p class="text-light">Total balance in wallets</p>
                        </div>
                        <div class="table-responsive">
                            <style>
                               
                            </style>
                            
                            <table class="table table-dark table-striped table-bordered">
                                <thead class=" text-uppercase">
                                    <tr>
                                        <th>Sn</th>
                                       <th>Wallet</th>
                                        <th>Amt</th>
                                        <?php echo $this->session->userdata('admin_state')=="on"?"<th>Admin action<br><small>Edit user ballance</small></th>":""?>
                                        <?php //echo $this->session->userdata('admin_state')=="on"?"<th>Admin action<br><small>Edit user ballance</small></th>":"<th>Wallet address</th>"?>
                                       
                                        <th class=" bg-dark">User Actions <br><small>Place withdrawal order | swap(2% fees) between coins and Sys-Token</small></th>
                                        <!-- <th class="alert-primary text-center">Action </th> -->
                                    </tr>
                                </thead>
                                <tbody id="get-crypto-data-response">

                                <!-- table result display's here using ajax -->

                                </tbody>
                            </table>

                            <script type="text/javascript">
                                $(document).ready(function() {
                                    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                                    $.ajax({

                                        url: "<?php echo base_url('make_withdrawal/getCryptocurrencyTableData'); ?>",
                                        method: 'POST',
                                        data: {
                                            <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                                        },
                                        success: function(data) {

                                            $("#get-crypto-data-response").html(data);
                                        }
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