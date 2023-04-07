<!-- staff dashboard -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- load head.php file -->
    <?php
    $this->load->view('staff/staff_login_check');
    $this->load->view('common/head');
    ?>



</head>

<body>


    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar" data-navbarbg="skin5">
            <!-- load header.php file -->
            <?php $this->load->view('common/header'); ?>



        </header>


        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <aside class="left-sidebar bg-info" data-sidebarbg="">
            <!-- load aside.php file -->
            <?php $this->load->view('common/staff_aside'); ?>

        </aside>


        <!-- Page wrapper  -->
        <!-- ============================================================== -->

        <div class="page-wrapper">
            <div class="container-fluid p-0" style="min-height: 80vh!important;">

                <!-- contents here -->

                <!--loader keeps the user informed when the  system is processing -->

                <?php $this->load->view('common/loader'); ?>

                <!-- dashboard content-->
                <div class="">
                    <div id="dashboard-content" class="col-12 col-md-12 p-1 m-0 ">
                        <div class="container-fluid bg-light p-3">

                            <h4 class=" text-dark"><u>Transaction history</u></h4>
                            <?php
                            $result = "";
                            if ($fetch_user_txn_total_sales_by_day->num_rows() > 0) {
                                echo "<div class='col-12 alert-success mb-3 p-2'>";
                                echo "<h6 class='text-success'>Daily sales</h6>";
                                foreach ($fetch_user_txn_total_sales_by_day->result() as $row) {
                                    echo '<a class="btn btn-success m-1 text-light">' . $row->date_created . ': NGN' . number_format($row->sales) . '</a>';
                                }
                                echo "</div>";
                            }
                            if ($fetch_user_txn_total_expenses_by_day->num_rows() > 0) {
                                echo "<div class='col-12 alert-danger p-2 my-3'>";
                                echo "<h6 class='text-danger'>Daily expenses</h6>";
                                foreach ($fetch_user_txn_total_expenses_by_day->result() as $row) {
                                    echo '<a class="btn btn-danger m-1 text-light">' . $row->date_created . ': NGN' . number_format($row->expenses) . '</a>';
                                }
                                echo "</div>";
                            }
                            if ($fetch_user_txn->num_rows() > 0) {
                                $sn = 0;
                                $textcolor = $bgcolor = "";
                                foreach ($fetch_user_txn->result() as $row) {

                                    $staffName = $this->session->userdata('staff_name');
                                    $sn++;
                                    $txnId = $row->txn_id;
                                    $txnType = $row->txn_type;
                                    $amount = number_format($row->amount);
                                    $txnPurpose = $row->txn_purpose;
                                    $date = $row->date;
                                    $edited_by_admin = $row->edited_by_admin;
                                    $date_created = $row->date_created;
                                    if ($edited_by_admin == "Yes") {
                                        $bgcolor = "alert-warning";
                    
                                        if ($txnType == "Expenses") {
                                            
                                            $textcolor='text-danger';
                                        } else if ($txnType == "Sales") {
                                           
                                            $textcolor='text-success';
                                        }
                    
                                    } else {
                                        if ($txnType == "Expenses") {
                                            $bgcolor = "bg-light";
                                            $textcolor='text-danger';
                                        } else if ($txnType == "Sales") {
                                            $bgcolor = "bg-light";
                                            $textcolor='text-success';
                                        }
                                    }

                                    $result = $result . "
                                    <div id='myResultRow' data-toggle='modal' href='#myAllTxnModal$sn' class='container p-1 col-12 col-md-3 col-lg-4 text-dark ' style='cursor:pointer;'>
                                
                                        <div class='container $bgcolor p-1 col-12' style='border:1px solid green'>
                                            <i>Ref: $txnId</i><i class='float-right badge-dark badge'>$sn</i><br>
                                            <i class=' fa fa-money-bill-alt $textcolor' style='font-size:24px'></i>
                                            $txnType made on <u class='text-info'>$date_created</u> <br>by <u class='text-info'>$staffName</u>
                                            <u class='$textcolor float-right'>NGN $amount</u>
                                        </div>
                                
                                    </div>
                                
                                    <div class='modal' id='myAllTxnModal$sn'>
                                        <div class='modal-dialog modal-lg'>
                                            <div class='modal-content'>
                                
                                                <!-- Modal Header -->
                                                <div class='modal-header'>
                                                    <h4 class='modal-title text-dark text-center font-weight-bold'>Transaction info</h4>
                                                    <button type='button' class='close text-danger' data-dismiss='modal'>&times;</button>
                                                </div>
                                
                                                <!-- Modal body -->
                                                <div id='edit-action-info' class='modal-body'>
                                
                                                    <div class=' container p-2  text-dark col-12 '>
                                                        <div class='container p-3' style='border:4px solid #f1f1f1'>
                                                            <h5 class='text-success bg-light' style='font-weight:700'>Txn created on $date_created</h5>
                                                            <hr> Ref: $txnId
                                                            <hr>Type: $txnType
                                                            <hr>
                                                            Amount: NGN $amount
                                                            <hr>Description: $txnPurpose
                                                            <hr>Initiator: $staffName
                                                            <hr>Date: $date
                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>
                                    </div>";
                                }
                            } else {
                                $result = "<h5 class='text-danger'>Sorry, no staff found!</h5>";
                            }
                            ?>
                            <div class="container-fluid bg-light ">

                                <p id="ajax-response"></p>
                                <div class="  text-center container col-12 p-0 my-2">
                                    <h4>All transactions <br />
                                        <i class="text-danger small">Note: <q>rows</q> marked with orange background indicate rows altered by the admin</i>
                                    </h4>
                                    <input type="text" id="myInput" placeholder="Transaction search..." class="form-control col-12">
                                </div>
                                <div id="myResult">
                                    <div class="row">
                                        <?php echo $result; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>





            </div>

            <div>
                <!-- load footer.php file -->
                <?php $this->load->view('footer'); ?>
            </div>
        </div>


        <!-- End Wrapper -->


        <!-- All Jquery and script below here -->
        <!-- load scripts.php file -->
        <?php $this->load->view('common/scripts'); ?>


        <!-- ============================================================== -->
    </div>


    <script>
        $(document).ready(function() {

            // perform search operation
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myResult #myResultRow").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>