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

        <td style="min-width:200px;vertical-align: top;">

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
              <h4 class="p-3">Investment packages</h4>
             <div class="jumbotron p-3">
              <button class="btn btn-sm btn-primary btn-lg mdi mdi-library-plus " data-toggle="modal" data-target="#add_package">
                Add new package
              </button>
              <button class="btn btn-sm btn-primary btn-lg mdi mdi-library-plus float-right " data-toggle="modal" data-target="#add_package">
                Add new package
              </button>
            </div>
              <thead class="">
                <tr>
                  <th class="text-right">#</th>
                  <th>Package type</th>
                  <th>Range</th>
                  <th>Profit</th>
                  <th>Status</th>
                  <th class="text-center">Action </th>
                </tr>
              </thead>
              <tbody>


                <?php
                if ($fetch_package->num_rows() > 0) {
                  $sn = 0;
                  foreach ($fetch_package->result() as $row) {
                    $sn++;
                    $pkg_id = $row->pkg_id;
                    $pkg_name = $row->pkg_name;
                    $pkg_min_amount = $row->pkg_min_amount;
                    $pkg_max_amount = $row->pkg_max_amount;
                    $pkg_max_amount_label = $row->pkg_max_amount_label;
                    $pkg_due_day = $row->pkg_due_day;
                    $pkg_percentage = $row->pkg_percentage;
                    $pkg_creator_id = $row->pkg_creator_id;
                    $pkg_status=$row->pkg_status;
                    $_day = "days";
                    if ($pkg_due_day < 2) {
                      $_day = "day";
                    }
                ?>

                    <tr>
                      <td class="text-right"><?= $sn ?></td>
                      <td><?= $pkg_name ?></td>
                      <td>$<?php echo number_format($pkg_min_amount,2) . " - $" . number_format($pkg_max_amount,2) . " | "  .$pkg_max_amount_label?></td>
                      <td><?php echo $pkg_percentage . "% after " . $pkg_due_day . " $_day" ?></td>
                      <td><?=$pkg_status?></td>
                      <td class="text-center">
                        <button class="btn btn-sm btn-primary  mdi mdi-table-edit  " data-toggle="modal" data-target="#edit_package<?php echo $pkg_id ?>">
                          Edit
                        </button>

                        <button class="btn-delete-package btn btn-sm btn-danger  mdi mdi-delete ml-2" data-toggle="modal" pkg_name="<?php echo $pkg_name ?>" id="<?php echo $pkg_id ?>">
                          Delete
                        </button>

                        <p class="text-info my-2" id="deleting<?php echo $pkg_id ?>"></p>
                        <p id="delete-package-response<?php echo $pkg_id ?>"></p>
                      </td>
                    </tr>

                
<script>
  $(document).ready(function() {
 // delete package

        $(".btn-delete-package").click(function() {
          var btn_del_pkg_id = $(this).attr('id');
          var pkg_name = $(this).attr('pkg_name');
          $("#deleting" + btn_del_pkg_id).html("Processing...");

          Swal.fire({
            title: '<h5>Notice:  "' + pkg_name + '" package will be deleted from the system</h5>',
            text: 'Do you really want to continue?',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            icon: 'info'
          }).then((result) => {
            if (result.isConfirmed) {

              var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
              $.ajax({

                url: "<?php echo base_url('txn_packages/delete_package'); ?>",
                method: 'POST',
                data: {
                  postAction: 'true',
                  packageId: btn_del_pkg_id,
                  <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                },
                success: function(data) {
                  $('#delete-package-response' + btn_del_pkg_id).html(data);
                }
              });



            } else {
              $("#deleting" + btn_del_pkg_id).html("");
            }
          })

        });
        // end of delete package 

  });
</script>
                
                <?php
                    require('edit_package_modal.php');
                  }
                } else {
                  echo $report = "<tr> <td colspan='6' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
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

  <!-- add package modal -->

  <!-- Modal -->
  <div class="modal fade" data-backdrop="static" id="add_package" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content bg-light text-dark">
        <div class="modal-header">
          <h4 class="modal-title">Add new package</h4>
          <button type="button" class="close close-my-modal" data-dismiss="modal">&times;</button>

        </div>
        <div class="modal-body">
          <form id="add-package-form" method="POST">
            <?php

            $attributes = array('role' => 'form', 'enctype' => 'multipart/form-data');
            echo form_open(base_url('package/process'), $attributes);

            ?>

            <div class="form-group">
              <p class='text-danger'>
                Note: Package name cannot contain special characters | symbols, all spaces are converted to underscore(_). 
              </p>
              <label for="package-name">Enter package name <small>(Alphabets and numbers only.) </small></label>
              <input type="text" name="packageName" id="package-name" class="form-control p_input" placeholder="Gold" required value="<?php echo set_value('packageName') ?>" />
              <span id="package-name-error" class="text-danger"> <?php echo form_error('packageName') ?> </span>
            </div>

            <div class="form-group">
              <label for="min-amount">Enter minimum amount <small>(Numbers only)</small></label>
              <input type="number" name="minAmount" id="min-amount" class="form-control" placeholder="Please enter minimum amount" required value="<?php echo set_value('minAmount') ?>">
              <span id="min-amount-error" class="text-danger"> <?php echo form_error('minAmount') ?> </span>
            </div>

            <div class="form-group">
              <label for="max-amount">Enter maximum amount <small>(Numbers only)</small></label>
              <input type="number" name="maxAmount" id="max-amount" class="form-control" placeholder="Please enter maximum amount" required value="<?php echo set_value('maxAmount') ?>">
              <span id="max-amount-error" class="text-danger"> <?php echo form_error('maxAmount') ?> </span>
            </div>

            <div class="form-group">
              <label for="max-amount-label">Enter label for the maximum amount <small>(This text will display instead of the maximum amount entered). . This can also be the same as maximum amount amove</small></label>
              <input type="text" name="maxAmountLabel" id="max-amount-label" class="form-control" placeholder="Please enter maximum amount label" required value="<?php echo set_value('maxAmountLabel') ?>">
              <span id="max-amount-label-error" class="text-danger"> <?php echo form_error('maxAmountLabel') ?> </span>
            </div>

            <div class="form-group">
              <label for="due-day">Enter package maturity day <small>(no. of days for investment to be ready for withdrawal. Numbers only)</small></label>
              <input type="number" name="dueDay" id="due-day" class="form-control" placeholder="3" required value="<?php echo set_value('dueDay') ?>">
              <span id="due-day-error" class="text-danger"> <?php echo form_error('dueDay') ?> </span>
            </div>

            <div class="form-group">
              <label for="percentage">Enter package percentage interest <small>(Numbers only)</small></label>
              <input type="number" name="percentage" id="percentage" class="form-control" placeholder="30" required value="<?php echo set_value('percentage') ?>">
              <span id="percentage-error" class="text-danger"> <?php echo form_error('percentage') ?> </span>
            </div>

            <div class="form-group">
              <input type="hidden" name="postAction" value="true">
              <button type="submit" id="add-package" class="btn btn-primary mdi mdi-library-plus"> Add package </button>
              <button type="button" class="btn btn-danger close-my-modal  mdi mdi-exit-to-app " data-dismiss="modal"> Cancel</button>
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

        //package-name formatting
 var package_name;
$('#package-name').keyup(function() {
package_name = $('#package-name').val();
// replace all spacess and double underscore (__) with single underscore (_)
 package_name = package_name.replaceAll(/[\s]/g, '_');
 package_name = package_name.replaceAll('__', '_');

// replace all special characters and numbers except  white spacess and underscore with ''
//package_name = package_name.replace(/[0-9]|[^\w\s]/gi, '');  
  
// replace all special characters except  white spacess and underscore with ''
package_name = package_name.replace(/[^\w\s]/gi, '');  
$('#package-name').val(package_name);
                                                
});
        
        
        // add package
        $("#add-package-form").on("submit", function(e) {
          e.preventDefault();
          $("#processing").html("Processing...");
          // ajax function
          $.ajax({
            url: "<?php echo base_url('txn_packages/add_package'); ?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
              $('#processing').html(data);
            }
          });
          // end of ajax function

        });
      });
    </script>

  </div>

  <!-- end add package modal -->



</body>



</html>