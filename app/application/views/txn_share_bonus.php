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

        <td style="width:200px; min-width:200px; vertical-align: top;">

          <?php $this->load->view('txn_nav.php') ?>
        </td>
        <td>
          <div class="">

            <div class="container col-12 col-md-6 bg-light p-4 my-4">

              <h4 class="p-3">Share bonus to members</h4>

              <div class="form-group">
                <label for="receiver">Select receiver</label>
                <select class="form-select form-control" id="receiver">
                  <option value="">Select..</option>
                  <option value="1">Specified user</option>
                  <option value="2">All users</option>
                  <option value="3">Users that have made deposit</option>
                  <option value="4">Users that have not made deposit</option>
                </select>

                <div class="p-4" id="username-div">
                  <span>Enter the receiver's username</span>
                  <input type="text" name="" id="username" class="form-control" placeholder="enter username of receiver">
                </div>
              </div>
              
              <div class="form-group">
                <label for="">Enter amount to share<small> (numbers only)</small></label>
                <input type="number" name="" id="amount" class="form-control" placeholder="enter amount to share">
              </div>

              <div class="">
                <button class="btn btn-block btn-primary" id="share-bonus">Share bonus</button>
              </div>
              <p id="share-action-response"></p>
            </div>

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
  $(document).ready(function() {
    $("#username-div").hide();
    $("#receiver").click(function(){
      if($("#receiver").val()=="1"){
        $("#username-div").show();
      }else{
        $("#username-div").hide();
        $("#username").val("");
      }
    });
    
    // share bonus
    $("#share-bonus").click(function() {
      //note: receiver cagegory => specified user=1; all users=2; users that have made deposit=3; users that have not made deposit=4
      var receiver = $("#receiver").val();
      var username = $("#username").val();
      var amount = $("#amount").val();
      var amountTest = parseInt($("#amount").val());
      var finalRceiver="";
      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';     
      if(receiver=='1'){
        finalRceiver=username;
      }else{
        finalRceiver=receiver;
      }


      if(finalRceiver==""){
        Swal.fire("Invalid receiver","",'error');return;
      }
      if(amountTest<1 || amount==""){
        Swal.fire("Invalid amount",'','error');return;
      }
      // Swal.fire(username,"",'success');return;
      Swal.fire({
        title: '<h5>Share bonus?</h5>',
        //text: 'Are you sure you want to carry out this action?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        icon: 'info'
      }).then((result) => {
        if (result.isConfirmed) {

          $('#share-action-response').html("<i>processing please wait..</i>")
          $.ajax({

            url: "<?php echo base_url('txn_share_bonus/share'); ?>",
            method: 'POST',
            data: {
              amount:amount,
              username:username,
              receiver:receiver,
              finalRceiver: finalRceiver,
              <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
            },
            success: function(data) {
              $("#share-action-response").html(data);
            }
          });


        }
      });
    });
    // end of share bonus


  });
</script>

</html>