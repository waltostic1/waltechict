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
              <h4 class="p-3">Deleted investment packages</h4>
             
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
                      <td>$<?php echo number_format($pkg_min_amount,2) . " - $" . number_format($pkg_max_amount,2) . " " ?></td>
                      <td><?php echo $pkg_percentage . "% after " . $pkg_due_day . " $_day" ?></td>
                      <td><?=$pkg_status?></td>
                      <td class="text-center">
                       
                        <button class="btn-restore-package btn btn-sm btn-danger  mdi mdi-undo ml-2" pkg_name="<?php echo $pkg_name ?>" id="<?php echo $pkg_id ?>">
                          Restore
                        </button>

                        <p class="my-2" id="action-response-<?php echo $pkg_id ?>"></p>
                      </td>
                    </tr>

                
<script>
  $(document).ready(function() {
 // restore package

        $(".btn-restore-package").click(function() {
          var btn_restore_pkg_id = $(this).attr('id');
          var pkg_name = $(this).attr('pkg_name');
          $("#action-response-" + btn_restore_pkg_id).html("Processing...");

          Swal.fire({
            title: '<h5>Notice:  "' + pkg_name + '" package will be restored and set to inactive</h5>',
            text: 'Do you really want to continue?',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            icon: 'info'
          }).then((result) => {
            if (result.isConfirmed) {

              var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
              $.ajax({

                url: "<?php echo base_url('txn_deleted_packages/restore_package'); ?>",
                method: 'POST',
                data: {
                  postAction: 'true',
                  packageId: btn_restore_pkg_id,
                  <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                },
                success: function(data) {                  
                 $("#action-response-" + btn_restore_pkg_id).html(data);
                }
              });



            } else {
              $("#action-response-" + btn_restore_pkg_id).html("");
            }
          })

        });
        // end of restore package 

  });
</script>
                
                <?php
                    
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

  

</body>



</html>