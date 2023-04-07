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
                            <?php
                            $result = "";
                            if ($fetch_staff->num_rows() > 0) {

                                foreach ($fetch_staff->result() as $row) {

                                    $userId = $row->sn;
                                    $fullName = $row->full_name;
                                    $userName = $row->user_name;
                                    $email = $row->email;
                                    $sex = $row->sex;
                                    $phone = $row->phone_no;
                                    $date = $row->date;
                                   
                                    $result = $result . "
                                        <div class=' container p-2  text-dark col-12 '>
                                            <div class='container p-3' style='border:4px solid #f1f1f1'>
                                                            
                                                Staff id: <b>Stf-00$userId</b> 
                                                <hr>Username: <b>$userName </b> 
                                                <hr>Full name: <b>$fullName </b> 
                                                <hr>Sex: <b>$sex </b> 
                                                <hr>Email: <b>$email </b> 
                                                <hr>Phone: <b>$phone</b> 
                                                <hr>Date: <b>$date</b> 
                                                <hr>
                                            </div>
                                        </div>
                                    ";
                                }
                            } else {
                                $result = "<h5 class='text-danger'>Sorry, no staff found!</h5>";
                            }

                            ?>
                            <div class="container">
                                <h5>Your profile</h5>
                                <?php echo $result; ?>
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
            $(document).on('click', '.delete-staff', function() {
                var staffId = $(this).attr('id');
                var msg = confirm('Warning! this action cannot be undone, are you sure you want to delete staff with id no. ' + staffId + '?');
                if (msg == true) {
                    $.ajax({
                        url: "<?php echo base_url('staff/view_staff/delete_staff'); ?>",
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

            $(document).on('click', '.edit-staff', function() {
                alert('Edit action coming soon');
            });

        });
    </script>
</body>

</html>