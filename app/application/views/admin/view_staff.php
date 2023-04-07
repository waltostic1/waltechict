<!-- admin dashboard -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- load head.php file -->
    <?php
    $this->load->view('admin/admin_login_check');
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
            <?php $this->load->view('common/aside'); ?>

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
                            <?php
                            $result2 = $result = "";
                            if ($fetch_staff->num_rows() > 0) {

                                foreach ($fetch_staff->result() as $row) {

                                    $userId = $row->user_id;
                                    $sn = $row->sn;
                                    $fullName = $row->full_name;
                                    $userName = $row->user_name;
                                    $email = $row->email;
                                    $sex = $row->sex;
                                    $phone = $row->phone_no;
                                    $date = $row->date;
                                    $result = $result . "<tr><td>$sn</td><td>$userName</td><td>$fullName</td>
                                    <td>$email</td><td>$sex</td><td>$phone</td><td>$date</td>
                                    <td>
                                    <a id='$sn' data-toggle='modal' href='#myModal' class=' edit-staff text-info m-1 'style=' text-decoration:underline'>Edit</a>
                                    <a id='$sn' href='javascript:void(0)' class='delete-staff text-danger m-1' style=' text-decoration:underline'>Delete</a></td></tr>";



                                    $result2 = $result2 . "
                                    <div class='myResultRow container p-1 col-12 col-md-4 text-dark '>

                                        <div class='container alert-warning p-1 col-12' style='border:1px solid green'>                                           
                                            
                                            <h6><i class=' mdi mdi-human-male float-right' style='font-size:24px'></i>$fullName  <u class='text-info'>($email)</u></h6>
                                             
                                            <div class='float-right'>
                                            <a id='' data-toggle='modal' href='#myModal$sn' class='text-info m-1 'style=' text-decoration:underline'>View</a>
                                            <a id='$sn' data-toggle='modal' href='#myModal' class=' edit-staff text-info m-1 'style=' text-decoration:underline'>Edit</a>
                                            <a id='$sn' href='javascript:void(0)' class='delete-staff text-danger m-1' style=' text-decoration:underline'>Delete</a>
                                            </div>
                                            <h6>$phone</h6>

                                        </div>

                                    </div>

                                    <div class='modal' id='myModal$sn'>
                                        <div class='modal-dialog modal-lg'>
                                            <div class='modal-content'>

                                                <!-- Modal Header -->
                                                <div class='modal-header'>
                                                    <h4 class='modal-title text-dark text-center font-weight-bold'>Staff info</h4>
                                                    <button type='button' class='close text-danger' data-dismiss='modal'>&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div id='' class='modal-body'>

                                                    <div class=' container p-2  text-dark col-12 '>
                                                        <div class='container p-3' style='border:4px solid #f1f1f1'>
                                                            
                                                            Staff id: <b>Stf-00$sn</b> 
                                                            <hr>Username: <b>$userName </b> 
                                                            <hr>Full name: <b>$fullName </b> 
                                                            <hr>Sex: <b>$sex </b> 
                                                            <hr>Email: <b>$email </b> 
                                                            <hr>Phone: <b>$phone</b> 
                                                            <hr>Date: <b>$date</b> 
                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";
                                }
                            } else {
                                $result2 = $result = "<h5 class='text-danger'>Sorry, no staff found!</h5>";
                            }

                            ?>
                            <style>
                                th {
                                    font-weight: bold !important;
                                }
                            </style>
                            <h4 class=" text-dark"><u>View Staffs</u></h4>

                            <div class="container-fluid p-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 p-2 text-center">
                                        <button id="btn-table-view" class="btn btn-info text-light form-control">Table view</button>
                                    </div>
                                    <div class="col-12 col-md-4 p-2 text-center">
                                        <button id="btn-box-view" class="btn btn-success text-light form-control">Box view</button>
                                    </div>
                                </div>
                            </div>
                            <input type="text" id="myInput" placeholder="Search..." class="form-control">

                            <div id="box-view">
                                <div class="container col-12" id="myDiv">
                                    <div class="row">
                                        <?php echo $result2; ?>
                                    </div>
                                </div>
                            </div>
                            <div id="table-view">
                                <table class="table table-bordered table-responsive table-striped">

                                    <p id="ajax-response"></p>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Username</th>
                                        <th>Full name</th>
                                        <th>Email</th>
                                        <th>Sex</th>
                                        <th>Phone</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody id="myTable">

                                        <?php echo $result; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- staff update modal -->

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <!--loader keeps the user informed when the  system is processing -->
                    <?php $this->load->view('loader'); ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title text-dark text-center font-weight-bold">Edit/update staff's info</h4>
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
            $(document).on('click', '.delete-staff', function() {
                var staffId = $(this).attr('id');
                var msg = confirm('Warning! this action cannot be undone, are you sure you want to delete staff with id no. ' + staffId + '?');
                if (msg == true) {
                    $.ajax({
                        url: "<?php echo base_url('admin/view_staff/delete_staff'); ?>",
                        method: "POST",
                        data: {
                            staffId: staffId
                        },
                        success: function(data) {
                            $('#ajax-response').html(data);
                        }
                    });
                }
            });

            // edit staff action
            $(document).on('click', '.edit-staff', function() {
                $('#edit-action-info').html('search...');
                var id = $(this).attr('id');
                $.ajax({
                    url: "<?php echo base_url('admin/view_staff/getStaffData'); ?>",
                    method: "POST",
                    data: {
                        staff_id: id
                    },
                    success: function(data) {
                        $('#edit-action-info').html(data);
                    }
                });

            });


            // perform search operation
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });

                $("#myDiv .myResultRow").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });


            $("#table-view").fadeOut(100); //show once document is ready

            $("#btn-table-view").click(function() {
                $("#box-view").hide(0);
                $("#table-view").fadeIn(500);
            });

            $("#btn-box-view").click(function() {
                $("#table-view").hide(0);
                $("#box-view").fadeIn(500);
            });

        });
    </script>



</body>

</html>