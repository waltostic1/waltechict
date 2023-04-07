<style>
    #navbarSupportedContent {
        background: #1b3968 !important;
    }
</style>
<nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header bg-info" data-logobg="skin5">
        <!-- This is for the sidebar toggle which is visible on mobile only -->
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <a class="navbar-brand" href="<?php echo base_url('index') ?>">
            <!-- Logo icon -->
            <b class="logo-icon p-l-10">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img src="<?php echo base_url('assets/images/') ?><?php $this->load->view('common/app_logo.html'); ?>" alt="[@]" class="light-logo" />
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text">
                <!-- dark Logo text -->
                <span class='text-warning'><?php $this->load->view('common/app_name.html'); ?></span>

            </span>
            <!-- Logo icon -->
            <!-- <b class="logo-icon"> -->
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

            <!-- </b> -->
            <!--End Logo icon -->
        </a>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Toggle which is visible on mobile only -->
        <!-- ============================================================== -->
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
    </div>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->



    <div class="navbar-collapse collapse " id="navbarSupportedContent">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-left mr-auto">
            <li class="nav-item d-none d-md-block">
                <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
            </li>

        </ul>
        <!-- ============================================================== -->
        <!-- Right side toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-right">


            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
                <span class='text-warning'>Welcome back</span><span class="font-weight-bold text-warning"> <?php echo $this->session->userdata('staff_name').$this->session->userdata('adminEmail'); ?></span>
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style="font-size:30px" class="mdi mdi-account-circle m-r-5 m-l-5"></i></a>
                <div class="dropdown-menu dropdown-menu-right user-dd animated">
                    <!-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i>
                                    My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i>
                                    My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i>
                                    Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item text-info" href="javascript:void(0)"><i class="fa fa-user-circle m-r-5 m-l-5"></i> <?php echo $this->session->userdata('staff_name').$this->session->userdata('adminEmail'); ?></a>
                    <a class="dropdown-item text-info" href="<?php echo base_url('logout') ?>"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                    <!-- <div class="dropdown-divider"></div>
                                <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div> -->
                </div>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
        </ul>
    </div>
</nav>