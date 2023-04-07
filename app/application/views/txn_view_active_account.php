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
          <style>
            table #my-table tbody tr td {
              padding: 5px !important;
            }
          </style>
          <h5 class="px-3">Active accounts | members</h5>
          <div id="user-data-response" class="bg-light p-2">

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

<script>
  // $(selected).load("url", "data", "callback") ({
  //   this();
  // });

  $(document).ready(function() {



    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
    $.ajax({
      url: "<?php echo base_url('txn_view_active_account/getUsersAllData'); ?>",
      method: 'POST',
      data: {
        <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
      },
      success: function(data) {
        $("#user-data-response").html(data);
      }
    });

  });
</script>

</html>