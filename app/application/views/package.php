<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("head.php");

$this->load->view("script.php"); ?>


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

          <div class="row">

            <!-- add package card -->
            <div class="col-xl-4 col-sm-6 grid-margin stretch-card" data-toggle="modal" data-target="#add_package">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <h6 class="text-primary">Add new package</h6>

                    </div>
                    <div class="col-3 p-0">
                      <button class="btn btn-sm btn-primary mdi mdi-library-plus " data-toggle="modal" data-target="#add_package">
                        Add
                      </button>
                    </div>
                  </div>
                  <h6 class="text-muted font-weight-normal pt-1 col-12">Packages are investment plans displayed to members</h6>

                  <button class="btn btn-sm btn-primary btn-block mdi mdi-library-plus " data-toggle="modal" data-target="#add_package">
                    Add package
                  </button>
                </div>
              </div>
            </div>
            <!-- end of add package card -->


            <div class="col-12">

              <div class="row">


                <?php
                if ($fetch_package->num_rows() > 0) {
                  foreach ($fetch_package->result() as $row) {
                    $pkg_id = $row->pkg_id;
                    $pkg_name = $row->pkg_name;
                    $pkg_min_amount = $row->pkg_min_amount;
                    $pkg_max_amount = $row->pkg_max_amount;
                    $pkg_due_day = $row->pkg_due_day;
                    $pkg_percentage = $row->pkg_percentage;
                    $pkg_creator_id = $row->pkg_creator_id;
                    $_day = "days";
                    if ($pkg_due_day < 2) {
                      $_day = "day";
                    }
                ?>
                    <!--  package card -->
                    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12 p-0">
                              <p class="text-light  mb-3 ">Package type: <?php echo  $pkg_name ?></p>
                            </div>
                            <div class="table">
                              <table class="table-bordered table ">
                                <tr>
                                  <td>Range:</td>
                                  <td>$<?php echo $pkg_min_amount . " - $" . $pkg_max_amount . " " ?></td>
                                </tr>
                                <tr>
                                  <td>Profit:</td>
                                  <td><?php echo $pkg_percentage . "% after " . $pkg_due_day . " $_day" ?></td>
                                </tr>
                              </table>
                            </div>


                            <div class="col-12 mt-4 text-center">
                              <button class="btn btn-sm btn-primary  mdi mdi-table-edit  " data-toggle="modal" data-target="#edit_package<?php echo $pkg_id ?>">
                                Edit
                              </button>

                              <button class="btn-delete-package btn btn-sm btn-danger  mdi mdi-delete " data-toggle="modal" pkg_name="<?php echo $pkg_name ?>" id="<?php echo $pkg_id ?>">
                                Delete
                              </button>

                              <p class="text-info my-2" id="deleting<?php echo $pkg_id ?>"></p>
                              <p id="delete-package-response<?php echo $pkg_id ?>"></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- end of package card -->






                <?php
                    require('edit_package_modal.php');
                  }
                }



                ?>
              </div>
            </div>

          </div>


          <!-- all modals here -->



          <!-- add package modal -->

          <!-- Modal -->
          <div class="modal fade" data-backdrop="static" id="add_package" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                  <button type="button" class="close close-my-modal" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add new package</h4>
                </div>
                <div class="modal-body">
                  <form id="add-package-form" method="POST">
                    <?php

                    $attributes = array('role' => 'form', 'enctype' => 'multipart/form-data');
                    echo form_open(base_url('package/process'), $attributes);

                    ?>

                    <div class="form-group">
                      <label for="package-name">Enter package name</label>
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
                      <button type="submit" id="add-package" class="btn btn-primary  mdi mdi-library-plus "> Add package </i></button>
                      <button type="button" class="btn btn-danger close-my-modal  mdi mdi-exit-to-app " data-dismiss="modal"> Cancel</button>

                      <p id="add-package-response"></p>
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

                        url: "<?php echo base_url('edit_package/delete_package'); ?>",
                        method: 'POST',
                        data: {
                          postAction: 'true',
                          packageId: btn_del_pkg_id,
                          <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                        },
                        success: function(data) {
                          $('#delete-package-response'+btn_del_pkg_id).html(data);
                        }
                      });



                    } else {
                      $("#deleting" + btn_del_pkg_id).html("");
                    }
                  })

                });
                // end of delete package 



                // add package
                $("#add-package-form").on("submit", function(e) {
                  e.preventDefault();
                  $("#processing").html("Processing...");
                  // ajax function
                  $.ajax({
                    url: "<?php echo base_url('package/add_package'); ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                      $('#add-package-response').html(data);
                    }
                  });
                  // end of ajax function

                });
              });
            </script>

          </div>

          <!-- end add package modal -->







          <!-- end of all modals -->

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