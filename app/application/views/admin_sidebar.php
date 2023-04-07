<?php
$this->load->view('admin_login_check');
require('login_session.php');

echo $this->session->flashdata('form');
$this->session->set_flashdata('form', '');
?>

<!-- sidebar -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo text-light font-weight-bolder text-decoration-none" href="../view">Bitnitro
      <!--<img src="assets/images/logo.svg" alt="logo" />-->
    </a>
    <a class="sidebar-brand brand-logo-mini mdi mdi-eye text-light font-weight-bold" href="../view">
      <!--<img src="assets/images/logo-mini.svg" alt="logo" />-->Bitnitro
    </a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="img/profile_photo/<?php echo $user_photo ?>" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal"><?php echo $user_username ?></h5>
            <span class="text-primary"><i class="text-light">Central id:</i> <?php echo $this->session->userdata('user_id') ?></span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="<?php echo base_url('profile') ?>" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-pocket text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Profile</p>
              <span class="text-primary"><small class="text-light">Central id:</small> <?php echo $this->session->userdata('user_id') ?></span>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>

        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo base_url() ?>admin_dashboard">
        <span class="menu-icon">
          <i class=" mdi mdi-view-dashboard "></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo base_url() ?>package">
        <span class="menu-icon">
          <i class=" mdi mdi-package-down "></i>
        </span>
        <span class="menu-title">Package</span>
      </a>
    </li>
<!-- 
    <li class="nav-item menu-items">
      <a class="nav-link collsapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Drop down</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic" >
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?php //echo base_url() ?>make_deposit"> Make deposit</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php //echo base_url() ?>deposit_history"> Deposit history</a></li>
        </ul>
      </div>
    </li> -->


    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo base_url() ?>cryptocurrency">
        <span class="menu-icon">
          <i class=" mdi mdi-coin "></i>
        </span>
        <span class="menu-title">Cryptocurrency</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo base_url() ?>wallet_address">
        <span class="menu-icon">
          <i class=" mdi mdi-package-down "></i>
        </span>
        <span class="menu-title">Wallet address</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link collsapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Transaction</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic" >
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url() ?>pending_deposit"> Pending deposit</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url() ?>disapproved_deposit"> Disapproved deposit</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url() ?>txn_pending_withdrawal"> Pending withdrawal</a></li>
          <!-- <li class="nav-item"> <a class="nav-link" href="<?php echo base_url() ?>pending_withdrawal"> Pending withdrawal</a></li> -->
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo base_url() ?>logout">
        <span class="menu-icon">
          <i class=" mdi mdi-logout "></i>
        </span>
        <span class="menu-title">Logout</span>
      </a>
    </li>


  </ul>
</nav>

