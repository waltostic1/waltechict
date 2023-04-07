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
                            $this->load->view('staff/txn_form');
                            ?>
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
</body>

</html>