<div>
    <?php

    function getAllMonths($m)
    {
        for ($m = 1; $m <= 12; $m++) {
            // prepend 0 to the value of the month( eg if month == 1 the month =01)
            if ($m < 10) {
                $m = "0" . $m;
            }
            echo "<option value='$m'>" . month($m) . "</option>";
        }
    }

    function month($month)
    {

        switch ($month) {
            case '12':
                return  "Dec.";
                break;
            case '11':
                return "Nov.";
                break;

            case '10':
                return "Oct.";
                break;

            case '09':
                return "Sept.";
                break;

            case '08':
                return "Aug.";
                break;

            case '07':
                return "July";
                break;

            case '06':
                return "June";
                break;

            case '05':
                return "May.";
                break;

            case '04':
                return "April";
                break;

            case '03':
                return "March";
                break;

            case '02':
                return "Feb.";
                break;

            case '01':
                return "Jan.";
                break;

            default:
                return "Invalid";
                break;
        }
    }
    ?>

    <h4 class=" text-dark"><u>Dashboard</u></h4>

    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-12 col-md-4 p-2 text-center">
                <button id="show-all-txn" class="btn btn-info text-light form-control">All transactions</button>
            </div>
            <div class="col-12 col-md-4 p-2 text-center">
                <button id="show-sales-summary" class="btn btn-success text-light form-control">Sales summary</button>
            </div>
            <div class="col-12 col-md-4  p-2 text-center">
                <button id="show-expenses-summary" class="btn btn-danger text-light form-control">Expenses summary</button>
            </div>
        </div>
    </div>
    <!-- All transactions -->
    <div>
        <?php


        if ($fetch_users_txn->num_rows() > 0) {
            $sn = 0;
            $result = "";
            foreach ($fetch_users_txn->result() as $row) {

                $staffName = $row->staff_user_name;
                if ($staffName == "") {
                    $staffName = "Removed";
                }
                $sn++;
                $txnId = $row->txn_id;
                $txnType = $row->txn_type;
                $amount = number_format($row->amount);
                $txnPurpose = $row->txn_purpose;
                $date = $row->txn_date;
                $date_created = $row->date_created;
                $edited_by_admin = $row->edited_by_admin;
                $bgcolor=$textcolor = "";
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
            $result = "<h5 class='text-danger'>Sorry, no result found!</h5>";
        }
        ?>

        <div class="container col-12 alert-info p-0 " id="all-txn-div">
            
            <div class="container-fluid bg-light ">

                <p id="ajax-response"></p>
                <div class="  text-center container col-12 p-0 my-2">
                <a href="javascript:void(0)" class="close btn-close text-danger p-3" id="close-all-txn-div">X</a>
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
    <!-- end of all transaction -->



    <!-- sales summary -->
    <div id="sales-summary" class="alert-info p-3 my-2 container-fluid">
        <a href="javascript:void(0)" class="close btn-close text-danger" id="close-sales-summary-div">X</a>
        <h5>Sales summary</h5>
        <?php
        $result = "";
        if ($fetch_users_txn_total_sales_by_day->num_rows() > 0) {
            echo "<div class='col-12 alert-success mb-3 py-2'>";
            echo "<h6 class='text-success'>Daily sales</h6>";
            echo "<div class='row'>";
            foreach ($fetch_users_txn_total_sales_by_day->result() as $row) {
                echo '<div class="form-control alert-success  col-12 col-md-4 col-lg-3"><a class="form-control text-center bg-dark text-light">' . $row->date_created . ': NGN' . number_format($row->sales) . '</a></div>';
            }
            echo "</div></div>";
        }


        ?>
        <div class='col-12 alert-success mb-3 p-2'>
            <h6 class='text-success'>Make a custom search on sales</h6>

            <div class="row container col-12">
                <select id="sales-month" class="form-control col-12 col-md-4 col-lg-3">
                    <option value="">Select month...</option>
                    <?php getAllMonths(''); ?>
                </select>
                <select id="sales-year" class="form-control col-12 col-md-4 col-lg-3">
                    <option value="">Select year...</option>
                    <?php
                    if ($fetch_existing_years->num_rows() > 0) {
                        foreach ($fetch_existing_years->result() as $row) {
                            echo "<option value=" . $row->year . ">$row->year</option>";
                        }
                    }
                    ?>
                </select>
                <button id='sales-search-btn' class="form-control col-12 col-md-4 col-lg-3 btn btn-success "><i class=" fa fa-search"> </i> Search</button>
                <div class="col-12 p-2">
                    <h6>Search results display here</h6>
                    <div class="bg-light text-light col-12 p-2" id="sales-result"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of sales-summary -->


    <!-- expenses summary -->
    <div id="expenses-summary" class="alert-warning p-3 my-2 container-fluid">
        <a href="javascript:void(0)" class="close btn-close text-danger" id="close-expenses-summary-div">X</a>
        <h5>Expenses summary</h5>
        <?php


        if ($fetch_users_txn_total_expenses_by_day->num_rows() > 0) {
            echo "<div class='col-12 alert-danger mb-3 py-2'>";
            echo "<h6 class='text-danger'>Daily expenses</h6>";
            echo "<div class='row'>";
            foreach ($fetch_users_txn_total_expenses_by_day->result() as $row) {
                echo '<div class="form-control alert-danger  col-12 col-md-4 col-lg-3"><a class="form-control text-center bg-dark text-light">' . $row->date_created . ': NGN' . number_format($row->expenses) . '</a></div>';
            }
            echo "</div></div>";
        }


        ?>
        <div class='col-12 alert-danger mb-3 p-2'>
            <h6 class='text-danger'>Make a custom search on expenses</h6>

            <div class="row container col-12">
                <select id="expenses-month" class="form-control col-12 col-md-4 col-lg-3">
                    <option value="">Select month...</option>
                    <?php getAllMonths(''); ?>
                </select>
                <select id="expenses-year" class="form-control col-12 col-md-4 col-lg-3">
                    <option value="">Select year...</option>
                    <?php
                    if ($fetch_existing_years->num_rows() > 0) {
                        foreach ($fetch_existing_years->result() as $row) {
                            echo "<option value=" . $row->year . ">$row->year</option>";
                        }
                    }
                    ?>
                </select>
                <button id='expenses-search-btn' class="form-control col-12 col-md-4 col-lg-3 btn btn-danger "><i class=" fa fa-search"> </i> Search</button>
                <div class="col-12 p-2">
                    <h6>Search results display here</h6>
                    <div class="bg-light text-light col-12 p-2" id="expenses-result"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of expenses summary -->


    <!-- txn update modal -->

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <!--loader keeps the user informed when the  system is processing -->
        <?php $this->load->view('loader'); ?>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-dark text-center font-weight-bold">Edit/update transaction's info</h4>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div id="edit-action-info" class="modal-body">

                </div>

            </div>
        </div>
    </div>


    <!-- end of user update modal -->
</div>

<script>
    $(document).ready(function() {

        $("#sales-summary").hide();
        $("#expenses-summary").hide();
        //$("#all-txn-div").hide();

        $("#show-sales-summary").click(function() {
            $("#sales-summary").fadeIn(500);
            $("#expenses-summary").hide();
            $("#all-txn-div").hide();
        });
        $("#show-expenses-summary").click(function() {
            $("#sales-summary").hide();
            $("#all-txn-div").hide();
            $("#expenses-summary").fadeIn(500);
        });

        $("#show-all-txn").click(function() {
            $("#sales-summary").hide();
            $("#all-txn-div").fadeIn(100);
            $("#expenses-summary").hide(0);
        });

        $("#close-sales-summary-div").click(function() {
            $("#sales-summary").hide();
        });

        $("#close-expenses-summary-div").click(function() {
            $("#expenses-summary").hide();
        });

        $("#close-all-txn-div").click(function() {
            $("#all-txn-div").hide();
        });


        // search for txn sales
        $('#sales-search-btn').click(function() {
            var sales_year = $('#sales-year').val();
            var sales_month = $('#sales-month').val();
            $.ajax({
                url: "<?php echo base_url('admin/dashboard/get_sales'); ?>",
                method: "POST",
                data: {
                    sales_year: sales_year,
                    sales_month: sales_month
                },
                success: function(data) {
                    $('#sales-result').html(data);
                }
            });

        });

        // search for txn expenses
        $('#expenses-search-btn').click(function() {
            var expenses_year = $('#expenses-year').val();
            var expenses_month = $('#expenses-month').val();
            $.ajax({
                url: "<?php echo base_url('admin/dashboard/get_expenses'); ?>",
                method: "POST",
                data: {
                    expenses_year: expenses_year,
                    expenses_month: expenses_month
                },
                success: function(data) {
                    $('#expenses-result').html(data);
                }
            });

        });

        // perform search operation
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myResult #myResultRow").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });


        // edit txn action
        $(document).on('click', '.edit-txn', function() {
            $('#edit-action-info').html('search...');
            var id = $(this).attr('id');
            $.ajax({
                url: "<?php echo base_url('admin/dashboard/getTxnData'); ?>",
                method: "POST",
                data: {
                    txn_id: id
                },
                success: function(data) {
                    $('#edit-action-info').html(data);
                }
            });

        });
    });
</script>