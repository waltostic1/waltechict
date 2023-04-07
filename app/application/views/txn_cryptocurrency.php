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

        <td style="width:200px;vertical-align: top;">

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
              <h4 class="p-3">Investment cryptocurrency</h4>
             <div class="jumbotron p-3">
              <button class="btn btn-sm btn-primary btn-lg mdi mdi-library-plus " data-toggle="modal" data-target="#add_cryptocurrency">
                Add new currency
              </button>
              <button class="btn btn-sm btn-primary btn-lg mdi mdi-library-plus float-right " data-toggle="modal" data-target="#add_cryptocurrency">
                Add new currency
              </button>
            </div>
              <thead class="">
                <tr>
                  <th class="text-right">#</th>
                  <th>Cryptocurrency</th>                  
                  <th>Created on</th>
                  <th>Status</th>
                  <th class="text-center">Action </th>                
                </tr>
              </thead>
              <tbody>


                <?php
                if ($fetch_cryptocurrency->num_rows() > 0) {
                  $sn=0;
                  foreach ($fetch_cryptocurrency->result() as $row) {
                    $sn++;
                    $crypto_id = $row->c_id;
                    $crypto_name = $row->c_name;
                    $crypto_table=$row->c_table;                   
                    $crypto_creator_id = $row->c_creator_id;
                    $crypto_status=$row->c_status;
                    $crypto_date=$row->c_date;
                ?>

                    <tr>
                      <td class="text-right"><?= $sn ?></td>
                      <td><?= $crypto_name ?></td>  
                      <td><?=$crypto_date ?></td> 
                      <td>
                       <select id="status-<?=$crypto_id?>" crypto-id="<?=$crypto_id?>" name="status" class="status form-control">
                              <?php if ($crypto_status == 'active') {
                                echo "<option value='$crypto_status'>$crypto_status</option>";
                                echo "<option value='inactive'>inactive</option>";
                              } else if ($crypto_status == 'inactive') {
                                echo "<option value='$crypto_status'>$crypto_status</option>";
                                echo "<option value='active'>active</option>";
                              } ?>
                         </select>
                        <p id="status-response-<?=$crypto_id?>"></p>
                      
                      </td>
                      <td class="text-center">
                        
                      <button class="btn-delete-cryptocurrency btn btn-sm btn-danger  mdi mdi-delete p-1 " data-toggle="modal" crypto_table="<?php echo $crypto_table ?>" crypto_name="<?php echo $crypto_name ?>" cryptocurrency-id="<?php echo $crypto_id ?>" id="delete-button-<?php echo $crypto_id ?>">
                                Delete
                              </button>
                      
                              <p class="text-info my-2" id="deleting<?php echo $crypto_id ?>"></p>
                              <!-- <p id="delete-cryptocurrency-response<?php echo $crypto_id ?>"></p> -->
                      </td>
                    </tr>
                
                
<script>
  $(document).ready(function() {

 // update cryptocurrency status
                    $("#status-<?= $crypto_id ?>").change(function() {
                         
                          var cryptoId = $(this).attr('crypto-id');
                          var status = $(this).val();

                          Swal.fire({
                            title: '<h5>Change status?</h5>',
                            text: 'Are you sure?',
                            showDenyButton: true,
                            confirmButtonText: 'Yes',
                            denyButtonText: 'No',
                            icon: 'info'
                          }).then((result) => {
                              if (result.isConfirmed) {
                                $("#status-response-<?= $crypto_id ?>").html("processing...");
                                  //alert(status);return;
                                  var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>'; $.ajax({
                                      url: "<?php echo base_url('txn_cryptocurrency/changeStatus'); ?>",
                                      method: 'POST',
                                      data: {
                                        cryptoId: cryptoId,
                                        status: status,
                                        <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                                      },
                                      success: function(data) {
                                        $("#status-response-<?= $crypto_id ?>").html(data);
                                        }
                                      });
                                  }
                                  else {
                                    $("#status-response-<?= $crypto_id ?>").html('');
                                    }
                                  });

                              });
                            // end of update user account status
    
    
                // delete cryptocurrency

                $("#delete-button-<?php echo $crypto_id ?>").click(function() {
                  var btn_del_crypto_id = $(this).attr('cryptocurrency-id');
                  var crypto_name = $(this).attr('crypto_name');
                  var crypto_table=$(this).attr('crypto_table');
                  $("#deleting" + btn_del_crypto_id).html("Processing...");

                  Swal.fire({
                    title: '<h5>Notice:  "' + crypto_name + '" will be deleted from the system</h5>',
                    text: 'Do you really want to continue?',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    icon: 'info'
                  }).then((result) => {
                    if (result.isConfirmed) {

                      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                      $.ajax({

                        url: "<?php echo base_url('txn_cryptocurrency/delete_cryptocurrency'); ?>",
                        method: 'POST',
                        data: {
                          postAction: 'true',
                          cryptocurrencyId: btn_del_crypto_id,
                          cryptocurrencyTable:crypto_table,
                          <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                        },
                        success: function(data) {
                          $("#deleting"+btn_del_crypto_id).html(data);
                        }
                      });



                    } else {
                      $("#deleting" + btn_del_crypto_id).html("");
                    }
                  });

                });
                // end of delete cryptocurrency 
  });
</script>

                <?php
                   
                  }
                } else {
                  echo $report = "<tr> <td colspan='2' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
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

          <!-- add cryptocurrency modal -->

          <!-- Modal -->
          <div class="modal fade" data-backdrop="static" id="add_cryptocurrency" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                  <button type="button" class="close close-my-modal" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add new cryptocurrency</h4>
                </div>
                <div class="modal-body">
                  <form id="add-cryptocurrency-form" method="POST">
                    <?php

                    $attributes = array('role' => 'form', 'enctype' => 'multipart/form-data');
                    echo form_open(base_url('txn_cryptocurrency/#'), $attributes);

                    ?>

                    <div class="form-group">
                      <label for="cryptocurrency-name">Enter cryptocurrency name</label>
                      <input type="text" name="cryptocurrencyName" id="cryptocurrency-name" class="form-control p_input" placeholder="bitcoin" required value="<?php echo set_value('cryptocurrency') ?>" />
                      <span id="cryptocurrency-name-error" class="text-danger"> <?php echo form_error('cryptocurrencyName') ?> </span>
                    </div>


                    <div class="form-group">
                      <input type="hidden" name="postAction" value="true">
                      <button type="submit" id="add-cryptocurrency" class="btn btn-primary  mdi mdi-library-plus "> Add cryptocurrency </i></button>
                      <button type="button" class="btn btn-danger close-my-modal  mdi mdi-exit-to-app " data-dismiss="modal"> Cancel</button>

                      <p id="add-cryptocurrency-response"></p>
                    </div>
                    <p id='processing' class='text-info py-2'></p>

                    <?php

                    echo form_close()

                    ?>
                </div>
                <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-danger close-my-modal" data-dismiss="modal">Cancel</button>
                </div> -->
              </div>

            </div>


            <script>
              $(document).ready(function() {

                // add cryptocurrency
                $("#add-cryptocurrency-form").on("submit", function(e) {
                  e.preventDefault();
                  $("#processing").html("Processing...");
                  //return
                  // ajax function
                  $.ajax({
                    url: "<?php echo base_url('txn_cryptocurrency/add_cryptocurrency'); ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                      $('#add-cryptocurrency-response').html(data);
                    }
                  });
                  // end of ajax function

                });
              });
            </script>

          </div>

          <!-- end add cryptocurrency modal -->




</body>



</html>