          <!-- edit package modal -->            
          <!-- Modal -->
          <div class="modal fade" data-backdrop="static" id="edit_package<?php echo $pkg_id ?>" role="dialog">
            <div class="modal-dialog modal-md">

              <!-- Modal content-->
              <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                  <h4 class="modal-title">Edit package <?php echo $pkg_name ?></h4>
                  <button type="button" class="close close-my-modal" data-dismiss="modal">&times;</button>
                  
                </div>
                <div class="modal-body">
                  <form id="edit-package-form<?php echo $pkg_id ?>" method="POST">
                    <?php

                    $attributes = array('role' => 'form', 'enctype' => 'multipart/form-data');
                    echo form_open(base_url('admin_register/process'), $attributes);

                    ?>

                    <div class="form-group">
                      <label for="package-name">Package name: <span class="text-primary h4"><?php echo $pkg_name ?></span></label>
                      <input type="hidden" readonly name="packageId" id="package-id" class="form-control p_input" required value="<?php echo $pkg_id ?>" />
                    </div>
                    
                      <div class="form-group">
                      <label for="package-status">Change status</label>
                     <select id="package-status" name="packageStatus" class="package-status form-control">
                              <?php if ($pkg_status == 'active') {
                                echo "<option value='$pkg_status'>$pkg_status</option>";
                                echo "<option value='inactive'>inactive</option>";
                              } else if ($pkg_status == 'inactive') {
                                echo "<option value='$pkg_status'>$pkg_status</option>";
                                echo "<option value='active'>active</option>";
                              } ?>
                            </select>
                       <span id="package-status-error<?php echo $pkg_id ?>" class="text-danger"> <?php echo form_error('pkgStatus') ?> </span>
                    </div>
                    

                    <div class="form-group">
                      <label for="min-amount">Enter minimum amount <small>(Numbers only)</small></label>
                      <input type="number" name="minAmount" id="min-amount" class="form-control" placeholder="Please enter minimum amount" required value="<?php echo  $pkg_min_amount ?>">
                      <span id="min-amount-error<?php echo $pkg_id ?>" class="text-danger"> <?php echo form_error('minAmount') ?> </span>
                    </div>

                    <div class="form-group">
                      <label for="max-amount">Enter maximum amount <small>(Numbers only)</small></label>
                      <input type="number" name="maxAmount" id="max-amount" class="form-control" placeholder="Please enter maximum amount" required value="<?php echo  $pkg_max_amount ?>">
                      <span id="max-amount-error<?php echo $pkg_id ?>" class="text-danger"> <?php echo form_error('maxAmount') ?> </span>
                    </div>

                    <div class="form-group">
                      <label for="max-amount-label">Enter label for the maximum amount <small>(This text will display instead of the maximum amount entered. This can also be the same as maximum amount amove)</small></label>
                      <input type="text" name="maxAmountLabel" id="max-amount-label" class="form-control" placeholder="Please enter maximum amount label" required value="<?php echo  $pkg_max_amount_label ?>">
                      <span id="max-amount-label-error<?php echo $pkg_id ?>" class="text-danger"> <?php echo form_error('maxAmountLabel') ?> </span>
                    </div>

                    <div class="form-group">
                      <label for="due-day">Enter package maturity day <small>(no. of days for investment to be ready for withdrawal. Numbers only)</small></label>
                      <input type="number" name="dueDay" id="due-day" class="form-control" placeholder="3" required value="<?php echo $pkg_due_day ?>">
                      <span id="due-day-error<?php echo $pkg_id ?>" class="text-danger"> <?php echo form_error('dueDay') ?> </span>
                    </div>

                    <div class="form-group">
                      <label for="percentage">Enter package percentage interest <small>(Numbers only)</small></label>
                      <input type="number" name="percentage" id="percentage" class="form-control" placeholder="30" required value="<?php echo $pkg_percentage ?>">
                      <span id="percentage-error<?php echo $pkg_id ?>" class="text-danger"> <?php echo form_error('percentage') ?> </span>
                    </div>

                    <div class="form-group">
                      <input type="hidden" name="postAction" value="true">
                      <button type="submit" id="save-package<?php echo $pkg_id ?>" class="btn btn-primary  mdi mdi-content-save-all "> Save </i></button>
                      <button type="button" class="btn btn-danger close-my-modal  mdi mdi-exit-to-app " data-dismiss="modal"> Cancel</button>
                
                      <p id="save-package-response<?php echo $pkg_id ?>"></p>
                    </div>
                    <p id='processing<?php echo $pkg_id ?>' class='text-info py-2'></p>

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

                // edit package
                $("#edit-package-form<?php echo $pkg_id ?>").on("submit", function(e) {
                  e.preventDefault();
                  $("#processing<?php echo $pkg_id ?>").html("Processing...");
                  var pkg_id=<?php echo $pkg_id ?>;
                  
                  // ajax function
                  $.ajax({
                    url: "<?php echo base_url('txn_packages/save_package'); ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                      $('#save-package-response'+pkg_id).html(data);
                    }
                  });
                  // end of ajax function

                });
              });
            </script>

          </div>

          <!-- end of edit package modal -->