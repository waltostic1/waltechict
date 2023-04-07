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

              <h4 class="p-3">Penalize members who defaulted</h4>

              <div class="form-group">
                  <span>Enter the receiver's username</span>
                  <input type="text" name="" id="username" class="form-control" placeholder="enter username of receiver">
             
              </div>
              
              <div class="form-group">
                <label for="">Enter penalty amount<small> (numbers only)</small></label>
                <input type="number" name="" id="amount" class="form-control" placeholder="enter penality amount">
              </div>

              <div class="form-group">
                <label for="comment">Enter comment (<small>reasons for penalty</small>)</label>
                <textarea class="form-control" id="comment" placeholder="enter reasons for penalty"></textarea>
              </div>

              <div class="">
                <button class="btn btn-block btn-primary" id="penalize">Save | penalize</button>
              </div>
              <p id="save-action-response"></p>
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
    
    // penalize action
    $("#penalize").click(function() {
      //note: receiver cagegory => specified user=1; all users=2; users that have made deposit=3; users that have not made deposit=4
      var username = $("#username").val();
      var amount = $("#amount").val();
      var comment=$("#comment").val();
      var amountTest = parseInt($("#amount").val());
      
      var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';     
     
      if(username==""){
        Swal.fire("Invalid receiver | username","",'error');return;
      }
      if(comment==""){
        Swal.fire("Please enter reasons for penalty","",'error');return;
      }
      if(amountTest<1 || amount==""){
        Swal.fire("Invalid amount",'','error');return;
      }
      // Swal.fire(username,"",'success');return;
      Swal.fire({
        title: '<h5>Penalize user?</h5>',
        //text: 'Are you sure you want to carry out this action?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        icon: 'info'
      }).then((result) => {
        if (result.isConfirmed) {

          $('#save-action-response').html("<i>processing please wait..</i>")
          $.ajax({

            url: "<?php echo base_url('txn_penalize/penalize'); ?>",
            method: 'POST',
            data: {
              comment:comment,
              amount:amount,
              username:username,
              <?php echo $this->security->get_csrf_token_name(); ?>: csrf_hash
            },
            success: function(data) {
              $("#save-action-response").html(data);
            }
          });


        }
      });
    });
    // end of penalize action

  });
</script>

</html>