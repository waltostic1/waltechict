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

        <td style="width:200px;min-width:200px;vertical-align: top;">
          <?php $this->load->view('txn_nav.php') ?>
        </td>
        <td style="vertical-align: top;">
          <style>
            table #my-table tbody tr td {
              padding: 5px !important;
            }
          </style>
          <h5 class="px-3">Members</h5>
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



   <!-- send mail modal -->

  <!-- Modal -->
  <div class="modal fade" data-backdrop="static" id="send-mail-modal" role="dialog">

    <div class=" modal-dialog modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Send mails to participant</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="">
            <p><input type="text" placeholder="Enter message title" id="msg_title" class="form-control"></p>
           <p><textarea placeholder="Enter your message" id="message" rows="6" class="form-control"></textarea></p>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <p><button class="btn btn-success m-2" id="send-mails-now"><i class="mdi mdi-email"> Send Mails Now</i> </button>
          <button type="button" class="btn btn-danger m-2" data-dismiss="modal"><i class="mdi mdi-close-box"> Cancel</i> </button></p>
          <p id="processing-mail"></p>
        </div>

      </div>
    </div>
  </div>

  <!-- end of send mail modal -->


</body>

<script>
  // $(selected).load("url", "data", "callback") ({
  //   this();
  // });

  $(document).ready(function() {



    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
    $.ajax({
      url: "<?php echo base_url('txn_view_users/getUsersAllData'); ?>",
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