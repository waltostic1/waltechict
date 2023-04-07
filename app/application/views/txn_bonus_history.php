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
            <h4 class="p-3">Bonus history</h4>
              <thead class="">
                <tr>
                  <th class="text-right">#</th>
                  <th>Username</th>
                  <th>Full name</th>                  
                  <th class="text-right text-success">Bonus earned </th>
                  <th>From</th><!--down line-->
                  <th>Comment | reason</th>
                  <th>Date</th>                 
                </tr>
              </thead>
              <tbody>


                <?php
               
                if ($fetch_user_with_bonus->num_rows() > 0) {
                 $total_amount= $sn = 0;
                  foreach ($fetch_user_with_bonus->result() as $row) {
                    $sn++;
                    $username=$row->username;
                    $bonus=$row->rr_bonus;
                    $full_name=$row->full_name;   
                    $sender=$row->rr_downline_username;
                    $comment=$row->rr_comment;
                    $date=$row->rr_date;
                    $total_amount=$total_amount+$bonus;


                ?>

                    <tr>
                      <td class="text-right"><?= $sn ?></td>
                      <td><?= $username ?></td>
                      <td><?= $full_name?></td>                      
                      <td class="text-right text-success">$<?=   number_format($bonus,2); ?></td>    
                      <td><?= $sender?></td>
                      <td><?= $comment?></td>  
                      <td><?= $date?></td>                
                    </tr>

                <?php
                  }
                } else {
                  $report = "<tr> <td colspan='4' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
                }

                ?>

              </tbody>
              <tfoot>
              <?php
                      if (isset($total_amount)) {
                        echo '<tr><td colspan="5">Total amount: <span class="text-success h6">$' . number_format($total_amount,2) . '</span></td></tr>';
                      } ?>
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


<script>
  $(document).ready(function() {


  });
</script>

</html>