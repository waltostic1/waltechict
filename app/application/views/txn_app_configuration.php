<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view('txn_head')?>

</head>


<body>

  <div class="">


    <table class="alert-info p-0" style="width: 90%; margin:auto">
      <tr>
        <td colspan="2">
          <?php $this->load->view('txn_header')?>
        </td>
      </tr>
      <tr>

        <td style="min-width:200px;vertical-align: top;">

          <?php $this->load->view('txn_nav.php')?>
        </td>
        <td style="vertical-align: top;">
          <div class="bg-light p-2">

            <style>
              table #my-table tbody tr td {
                padding: 5px !important;
              }
            </style>



            <table id="my-table" class="display table nowrap table-striped table-bordered ">
              <h4 class="p-3">App configuration email will be used to send messages to members</h4>
              <thead class="">
                <tr>
                  <th class="text-right">#</th>
                  <th>System email address</th>
                  <th>Automatic re-investment</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
if ($fetch_config->num_rows() > 0) {
    $sn = 0;
    foreach ($fetch_config->result() as $row) {
        $sn++;
        $config_email = $row->config_email;
        $config_id = $row->config_id;
        $config_auto_reinvest=$row->config_auto_reinvest;
       
        ?>

                    <tr>
                      <td class="text-right"><?=$sn?></td>
                      <td class="text-center">
                        <input type="email" id="config-email" class="form-control" placeholder="Enter app configuration email" name="config_email" value="<?=$config_email?>">
                      </td>
                      <td class="text-center">
                        <select id="reinvest" class="form-control">
                          <?php
                        if($config_auto_reinvest=="0"){
                          echo '<option value="0">Off</option>';
                          echo '<option value="1">On</option>';
                        }else{
                          echo '<option value="1">On</option>';
                          echo '<option value="0">Off</option>';
                        }
                        ?>                         
                        </select>
                      </td>
                      <td>
                       <button class="btn btn-sm btn-primary  mdi mdi-save" id="config-<?=$config_id?>" config-id="<?=$config_id?>">
                          Save
                        </button>
                        <p id="save-response"></p>
                      </td>
                    </tr>

<script>
  $(document).ready(function() {
    // save configuration email
        $("#config-<?=$config_id?>").click(function() {
         
          var configId = $(this).attr('config-id');
          var configEmail = $("#config-email").val();
          var reinvest = $("#reinvest").val();
          
          $("#save-response").html("Processing...");

           var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
              $.ajax({

                url: "<?php echo base_url('txn_app_configuration/save_config'); ?>",
                method: 'POST',
                data: {
                  postAction: 'true',
                  configEmail: configEmail,
                  configId:configId,
                  reinvest:reinvest,
                  <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
                },
                success: function(data) {
                  $("#save-response").html(data);
                }


        });
        // end of delete package
  });
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

    <?php $this->load->view('txn_script')?>
  </div>

</body>



</html>