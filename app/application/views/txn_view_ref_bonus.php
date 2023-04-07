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
            <h4 class="p-3">Bonus | top earners</h4>
              <thead class="">
                <tr>
                  <th class="text-right">#</th>
                  <th>Username</th>
                  <th>Full name</th>
                  <th class="text-right text-success">Total bonus earned </th>
                </tr>
              </thead>
              <tbody>


                <?php
               
                if ($fetch_user_with_bonus->num_rows() > 0) {
                  $sn = 0;
                  foreach ($fetch_user_with_bonus->result() as $row) {
                    $sn++;
                    $username=$row->username;
                    $total_bonus=$row->total_bonus;
                    $full_name=$row->full_name;                 
                ?>

                    <tr>
                      <td class="text-right"><?= $sn ?></td>
                      <td><?= $username ?></td>
                      <td><?= $full_name?></td>                      
                      <td class="text-right text-success"><?=   number_format($total_bonus,2); ?></td>                      
                    </tr>

                <?php
                  }
                } else {
                  $report = "<tr> <td colspan='4' class='text-center p-4 h1'>Hmm! no record found at the moment</td></tr>";
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


<script>
  $(document).ready(function() {


  });
</script>

</html>