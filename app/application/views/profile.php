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
        $txnPin = $row->txn_pin;
      
      	$this->session->set_userdata('email',$email);
      	$this->session->set_userdata('txn_pin',$txnPin);
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
        <?php $this->load->view("sidebar.php");?>
        <!-- end of sidebar -->

        <div class="container-fluid page-body-wrapper">

            <!-- navbar -->
            <?php $this->load->view("navbar")?>
            <!-- end of navbar -->

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-12 p-0">


                                <div class="container bg-gray-dark p-3 mb-3">

                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-light " data-toggle="modal" data-target="#update-profile-photo">
                                                <span class="col-12 p-1 btn btn-info "><small>Central id:</small> <?php echo $this->session->userdata('user_id') ?></span>
                                                <div> <img src="img/profile_photo/<?php echo $photo ?>" alt="" width="100px" height="100px" style="border-radius: 100%;"></div>
                                                <a class="btn btn-info">change photo</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 h5 ">Edit Profile</p>
                                        </div>
                                    </div>

                                    <?php

$attributes = array('role' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'edit-profile-form');
echo form_open(base_url('profile/saveprofile'), $attributes);
?>
                                    <div class="card-body px-2 ">
                                        <p class="text-uppercase h6 text-sm">User Information</p>
                                        <div class="row my-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="username" class="form-control-label">Username</label>
                                                    <input class="form-control" readonly required name="username" id="username" type="text" value="<?php echo $username ?>" placeholder="Enter username">
                                                    <span class="text-danger"> <?php echo form_error('username') ?> </span>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="username" class="form-control-label">Referral link:<br>
                                                        <span class="text-primary " id="link"> <?php echo base_url('register') . "?ref=$username" ?> </span>
                                                        <i id="copy-link" class=" btn mdi mdi-content-copy p-0 m-0  " style="font-size: 12px !important;">copy</i>
                                                    </label>

                                                    <textarea id="ref-link" rows="1" readonly class="form-control p-1 " style="font-size: 12px !important; background-color:#181B23!important"></textarea>



                                                    <script>
                                                        $("#copy-link, #link").click(function() {
                                                            var link = $("#link").html();
                                                            //alert(s);
                                                            $('#ref-link').html(link);
                                                            var copyText = $("#ref-link").val();
                                                            $("#ref-link").select();
                                                            document.execCommand('copy');
                                                            Swal.fire('Referral link copied', copyText, 'success');
                                                        });
                                                    </script>

                                                </div>
                                            </div>



                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="full-name" class="form-control-label">Full name</label>
                                                    <input class="form-control" required name="full_name" id="full-name" type="text" maxlength="50" minlength="4" value="<?php echo set_value('full_name') != '' ? set_value('full_name') : $fullName ?>" placeholder="Enter full name">
                                                    <span class="text-danger"> <?php echo form_error('full_name') ?> </span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Email address</label>
                                                    <input class="form-control" required name="email" id="email" type="email" maxlength="50" minlength="4" placeholder="example@mail.com" value="<?php echo set_value('email') != '' ? set_value('email') : $email; ?>">
                                                    <span class="text-danger"> <?php echo form_error('email') ?> </span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="telephone" class="form-control-label">Telephone</label>
                                                    <input class="form-control" required name="telephone" type="text" maxlength="11" minlength="11" value="<?php echo set_value('telephone') != '' ? set_value('telephone') : $phone ?>" placeholder="Enter telephone number" id="telephone">
                                                    <span class="text-danger"> <?php echo form_error('telephone') ?> </span>
                                                </div>
                                            </div>




                                        </div>
                                        <hr class="horizontal dark">


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" name="save_profile" value="save profile">
                                                    <input type="hidden" name="user_id" value="<?php echo $userId ?>">
                                                    <button type="submit" name="save" id="save" class="btn btn-primary"><i class="mdi mdi-content-save"></i>Save</button>
                                                </div>
                                            </div>
                                        </div>
                                        <p id="save-profile-response"></p>
                                    </div>
                                    <?php echo form_close() ?>
                                </div>


                              <?php 
  								if($txnPin==""){
  									
									
                              
  
                              ?>

                                <div class="card my-5">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 h5 ">Create four (4) digits transaction PIN</p>
                                        </div>
                                    </div>

                                    <?php

$attributes = array('role' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'save-pin-form');
echo form_open(base_url('profile/save_pin'), $attributes);
?>
                                    <div class="card-body px-2 ">
                                        <div class="row my-3">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pin" class="form-control-label">Enter four (4) digits PIN</label>
                                                    <input class="form-control" required name="txn_pin" id="txn-pin" type="number"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" minlength="4" placeholder="Enter PIN">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="save_pin" id="btn-save-pin" data-user-id="<?=$userId?>" class="btn btn-primary"><i class="mdi mdi-content-save"></i>Save</button>
                                                </div>
                                              <p id="save-pin-response"></p>
                                            </div>

                                        </div>

                                    </div>
                                    <?php echo form_close() ?>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('#save-pin-form').on('submit', function(e) {
                                            e.preventDefault();
                                            //var user_id = $('#btn-save-password').attr("data-user-id");
                                            var txn_pin = $("#txn-pin").val();
                                            var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

											$("#save-pin-response").html('<span class="text-primary">Processing...</span>');
                                            $.ajax({
                                                url: "<?php echo base_url('profile/save_user_pin'); ?>",
                                                method: 'POST',
                                                data: {
                                                    txn_pin: txn_pin,
                                                    <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                                                },
                                                success: function(data) {
                                                    $("#save-pin-response").html(data);
                                                },
                                                error:function(result_d){
                                                    $("#save-pin-response").html(result_d);
                                                }

                                            });
                                        });
                                    });
                                </script>


                            </div>
                          <!--end of create txn pin-->






                          <?php } else{?>

                          <!-- reset txn pin-->
						<div class="col-12 p-0">
						  <div class="card my-5">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 h5 ">Reset your four (4) digits transaction PIN</p>                                          
                                        </div>
                                    </div>

                                    <?php

$attributes = array('role' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'reset-pin-form');
echo form_open(base_url('profile/save_pin'), $attributes);
?>
                                    <div class="card-body px-2 ">
                                        <div class="row my-3">
                                          
                                           <div class="col-12 mb-3">
                                                <div class="form-group">
                                                  
                                                   <h6><span class='text-primary'><u>Step 1:</u></span><br>
                                                     Request for ten (10) characters <code>reset code</code> 
                                                     
                                                  </h6> <button type="button" id="btn-get-code" class="btn btn-primary"><i class=" mdi mdi-settings "></i>Get reset code</button>
                                                </div>
                                              <p id="reset-code-request-response"></p>
                                             
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                  <span class='text-primary'><u>Step 2:</u></span><br>
                                                    <label for="reset-code" class="form-control-label">Enter the ten (10) characters <code>reset code</code>  sent to your email</label>
                                                    <input class="form-control" required name="reset_code" id="reset-code" type="text" maxlength="10" minlength="10" placeholder="Enter 10 characters reset code">
                                                </div>
                                              
                                          </div>
                                          
                                           <div class="col-md-6 mt-3">


                                             
                                                <div class="form-group">
                                                    
                                                      <br>
                                                      
                                                  <label for="pin" class="form-control-label">Enter your new four (4) digits transaction PIN</label>
                                                    <input class="form-control" required name="txn_pin" id="new-txn-pin" type="number"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" minlength="4" placeholder="Enter new PIN">
                                                </div>
                                             
                                          </div>
                                          
                                           <div class="col-12">
                                                <div class="form-group">
                                                    <button type="submit" name="save_pin" id="btn-save-pin" data-user-id="<?=$userId?>" class="btn btn-primary"><i class=" mdi mdi-settings "></i>Reset</button>
                                                </div>
                                              <p id="reset-pin-response"></p>
                                            </div>



                                        </div>

                                    </div>
                                    <?php echo form_close() ?>
						  </div>

                                <script>
                                    $(document).ready(function() {
                                        $('#reset-pin-form').on('submit', function(e) {
                                            e.preventDefault();
                                            var txn_pin = $("#new-txn-pin").val();
                                          	var reset_code=$("#reset-code").val();
                                            var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

											$("#reset-pin-response").html('<span class="text-primary">Processing...</span>');
                                            $.ajax({
                                                url: "<?php echo base_url('profile/reset_user_pin'); ?>",
                                                method: 'POST',
                                                data: {
                                                  	reset_code:reset_code,
                                                    txn_pin: txn_pin,
                                                    <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                                                },
                                                success: function(data) {
                                                    $("#reset-pin-response").html(data);
                                                },
                                                error:function(result_d){
                                                    $("#reset-pin-response").html(result_d);
                                                }

                                            });
                                        });
                                    });
                                </script>


                            </div>
                          <!--end of reset txt pin-->
                          <?php }?>

                            <div class="col-12 p-0 my-4">

                                <div class="card bg-light">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 h5 text-dark ">Cryptocurrency | Wallet Address</p>
                                        </div>
                                    </div>


                                    <div class="card-body px-2 ">
                                        <p class="text-uppercase h6 text-sm mb-4 text-primary">Update your Wallet address</p>
                                        <div class="row my-3">

                                            <!-- get all cryptocurrency and user address -->
                                            <?php if ($get_cryptocurrency->num_rows() > 0) {
    foreach ($get_cryptocurrency->result() as $row) {
        $cryptoName = $row->c_name;
        $cryptoTable = $row->c_table;
        $this->session->set_userdata('crypto_table_name', $cryptoTable);

        ?>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {

                                                            var cryptoTable = "<?php echo $cryptoTable ?>";
                                                            var cryptoName = "<?php echo $cryptoName ?>";
                                                            var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                                                            $.ajax({

                                                                url: "<?php echo base_url('profile/getCryptocurrencyTableData'); ?>",
                                                                method: 'POST',
                                                                data: {
                                                                    tableName: cryptoTable,
                                                                    <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                                                                },
                                                                success: function(data) {

                                                                    $("#wallet-" + cryptoTable).val(data);

                                                                    $("#response-wallet-" + cryptoTable).html(data);
                                                                }
                                                            });


                                                        });
                                                    </script>

                                                    <div class="col-md-6 ">

                                                        <?php
//$attributes = array('role' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'edit-wallet-form');
        //echo form_open(base_url('profile/saveprofile'), $attributes);
        ?>
                                                        <div class="form-group bg-dark p-4">
                                                            <div class="mb-4">
                                                                <?=($cryptoName . " address: ")?><span id="response-wallet-<?=$cryptoTable?>" class=" text-small text-primary text-decoration-underline"></span>
                                                            </div>
                                                            <label for="wallet-<?php echo $cryptoTable ?>" class="form-control-label">Enter <?php echo $cryptoName ?> wallet address</label>
                                                            <input class="form-control" required name="<?=$cryptoTable?>" id="wallet-<?php echo $cryptoTable ?>" type="text" placeholder="Enter <?=$cryptoName?> wallet address">
                                                          
                                                          <br><label for="txn-pin-<?php echo $cryptoTable ?>" class="form-control-label">Enter your four(4) digits transaction PIN</label>
                                                            <input <?php echo $this->session->userdata('admin_state')=="on"? "type='text' value='0000'":"type='password' value='0000'" ?> class="form-control" required  id="txn-pin-<?php echo $cryptoTable ?>" maxlength="4" minlength="4" placeholder="Enter transaction PIN">
                                                          
                                                            <button type="submit" name="save" id="save" data-cryptoTable="<?=$cryptoTable?>" class="btn-save-wallet btn btn-sm btn-primary my-2"><i class="mdi mdi-content-save"></i>Save <?=$cryptoName?></button>


                                                        </div>
                                                        <?php //echo form_close();
        ?>

                                                    </div>

                                            <?php

    }
}?>

                                            <!-- end get all cryptocurrency and user address -->

                                            <script>
                                                $(document).ready(function() {

                                                    // save user wallet address
                                                    $('.btn-save-wallet').click(function() {
                                                        var tableName = $(this).attr('data-cryptoTable');
                                                        var walletAddress = $('#wallet-' + tableName).val();
                                                      	var txnPin = $('#txn-pin-' + tableName).val();
                                                        var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                                                        // alert(walletAddress);
                                                        $.ajax({

                                                            url: "<?php echo base_url('profile/save_wallet'); ?>",
                                                            method: 'POST',
                                                            data: {
                                                              	txnPin:txnPin,
                                                                tableName: tableName,
                                                                walletAddress: walletAddress,
                                                                <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                                                            },
                                                            success: function(data) {
                                                                $("#response-wallet-" + tableName).html(data);
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


                <!-- update-profile-photo modal -->
                <div class="container">
                    <!-- Modal -->
                    <div class="modal fade" data-backdrop="static" id="update-profile-photo" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content bg-light text-dark">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Update profile photo</h4>
                                </div>
                                <!-- form open -->
                                <?php
$attributes = array('role' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'edit-profile-photo-form');
echo form_open(base_url('profile/saveprofilephoto'), $attributes);
?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <p>Maximum size: 2.5mb<br> Image type|format: .gif|.GIF|.jpg|.JPG|.jpeg|.JPEG|.png|.PNG</p>
                                        <label class="h5" for="profile-photo">Select an image</label>
                                        <input type="file" required name="profile_photo" id="photo" class="form-control">
                                        <input type="hidden" name="previous_profile_photo" id="previous-photo" value="<?php echo $photo ?>" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary " name="save" id="save"><i class="mdi mdi-content-save"></i>Save</button>
                                        <p id="join-group-response"></p>
                                    </div>

                                </div>
                                <?php echo form_close() ?>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
                                </div>
                                <p id="save-profile-photo-response"></p>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- end of join group modal -->


                <!-- content-wrapper ends -->
                <!-- footer -->
                <?php $this->load->view("footer.php");?>
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

            // save profile photo
            $('#edit-profile-photo-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?php echo base_url('profile/saveprofilephoto'); ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#save-profile-photo-response').html(data);
                    }
                });

            });

          
                      // get txn code function
            $('#btn-get-code').click(function() {
                
                var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                         
              $("#reset-code-request-response").html('Processing...');
                $.ajax({

                  url: "<?php echo base_url('profile/get_txn_reset_code'); ?>",
                  method: 'POST',
                  data: {       
                  <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                  },
                  success: function(data) {
                  $("#reset-code-request-response").html(data);
                  }
                });

            });
          // end of get txn code function
          


        });
    </script>
</body>

</html>