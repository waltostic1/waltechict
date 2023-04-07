<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("head.php");
$this->load->view("script.php");
?>

<body>

    <div class="container-scroller">

        <!-- sidebar -->
        <?php $this->load->view("admin_sidebar.php"); ?>
        <!-- end of sidebar -->

        <div class="container-fluid page-body-wrapper">

            <!-- navbar -->
            <?php $this->load->view("admin_navbar") ?>
            <!-- end of navbar -->

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="container-fluid ">
                        <div class="row">
                            

                            <div class="col-12 p-0 my-4">



                                <div class="card bg-light">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 h5 text-dark ">Cryptocurrency | Wallet Address</p>
                                        </div>
                                    </div>


                                    <div class="card-body px-2 ">
                                        <p class="text-uppercase h6 text-sm mb-4 text-primary">Update company's Wallet address</p>
                                        <div class="row my-3">

                                            <!-- get all cryptocurrency and user address -->
                                            <?php if ($get_cryptocurrency->num_rows() > 0) {
                                               
                                                foreach ($get_cryptocurrency->result() as $row) {
                                                    $cryptoId=$row->c_id;
                                                    $cryptoName = $row->c_name;
                                                    $cryptoTable = $row->c_table;
                                                    $walletAddress=$row->c_admin_wallet_address;

                                            ?>                                                    
                                                    <div class="col-md-6 ">
                                                       
                                                        <div class="form-group bg-dark p-4">
                                                            <div class="mb-4">
                                                                <?= ($cryptoName . " address: ") ?><span id="response-wallet-<?= $cryptoId  ?>" class=" text-small text-primary text-decoration-underline"><?= $walletAddress ?></span>
                                                            </div>
                                                            <label for="wallet-<?php echo $cryptoTable ?>" class="form-control-label">Enter <?php echo $cryptoName ?> wallet address</label>
                                                            <input class="form-control" required id="wallet-<?= $cryptoId ?>" type="text" value="<?= $walletAddress ?>" placeholder="Enter <?= $cryptoName ?> wallet address">
                                                            <button type="submit" name="save" id="save" data-cryptoId="<?= $cryptoId ?>" class="btn-save-wallet btn btn-sm btn-primary my-2"><i class="mdi mdi-content-save"></i>Save <?= $cryptoName ?></button>
                                                        </div>
                                                       
                                                    </div>

                                            <?php

                                                }
                                            } ?>

                                            <!-- end get all cryptocurrency and user address -->

                                            <script>
                                                $(document).ready(function() {

                                                    // save user wallet address
                                                    $('.btn-save-wallet').click(function() {
                                                        var cryptoId = $(this).attr('data-cryptoId');
                                                        var walletAddress = $('#wallet-' + cryptoId).val();
                                                        var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                                                        //alert(cryptoId);return
                                                        $.ajax({

                                                            url: "<?php echo base_url('wallet_address/save_wallet'); ?>",
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