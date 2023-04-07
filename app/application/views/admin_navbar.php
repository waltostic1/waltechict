<?php
$this->load->view('admin_login_check');
require('login_session.php')
?>

<!-- partial:partials/_navbar.html -->
<nav class="navbar p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
    <a class="navbar-brand brand-logo-mini mdi mdi-eye text-light font-weight-bolder text-center" href="../view">
      <!--<img src="assets/images/logo-mini.svg" alt="logo" />-->Bitnitro
    </a>
  </div>
  <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav w-100">
      <li class="nav-item w-100">
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">

      <li class="nav-item dropdown border-left">
        <a class="nav-link  count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">

          <i class="  mdi mdi-trophy "></i>
          <?php //echo $this->session->userdata('previous_unit') ?>
          <span class="count bg-success"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
          <h6 class="p-3 mb-0">Vote options</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" data-toggle="modal" data-target="#castVoteModal">
            <button class="btn btn-icon ">
              <i class="mdi mdi-vote text-success"></i>
            </button>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1">Cast vote</p>
              <p class="text-muted mb-0">You can vote multiple times</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" data-toggle="modal" data-target="#buyVotingUnitModal">
            <button class="btn btn-icon ">
              <i class="mdi mdi-flask-outline text-primary"></i>
            </button>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1">Top up unit</p>
              <p class="text-muted mb-0">You have <span class="text-success"><?php echo $this->session->userdata('previous_unit') ?></span> units left </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" data-toggle="modal" data-target="#shareVotingUnitModal">
            <button class="btn btn-icon ">
              <i class=" mdi mdi-share-variant text-warning"></i>
            </button>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1">Share with a friend</p>
              <p class="text-muted mb-0">You have <span class="text-success"><?php echo $this->session->userdata('previous_unit') ?></span> units left </p>
            </div>
          </a>
         
          <div class="dropdown-divider"></div>
          
        </div>
      </li>
      <li class="nav-item dropdown border-left">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="mdi mdi-account-group mdi-24px "></i>
          <!-- <span class="count bg-success"></span> -->
        </a>
        
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <h6 class="p-3 mb-0">Group activities</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="<?php echo base_url('groups') ?>">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-account-group text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="">Groups</p>
              <!-- <p class="text-muted ellipsis mb-0"></p> -->
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="<?php echo base_url('active_group') ?>">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-account-group-outline text-danger"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Active group</p>
              <!-- <p class="text-muted ellipsis mb-0"> Update dashboard </p> -->
            </div>
          </a>


          <!-- check membership type if it is admin  -->
          <?php

          $check_membership_type = $this->session->userdata('membership_type'); // session set @ view(active_group)
          $num_of_request = $this->session->userdata('pending_request');
          // if admin, display the content
          if ($check_membership_type == 'admin') {
          ?>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item" href="<?php echo base_url('group_notification') ?>">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-bell text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">Notification</p>
                <p class="text-muted ellipsis mb-0"><?php echo $num_of_request ?> </p>
              </div>
            </a>

          <?php } ?>


          <div class="dropdown-divider"></div>
          <p class="p-3 mb-0 text-center">See all notifications</p>
        </div>
      </li>
      <li class="nav-item dropdown border-left border-right">
        <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
          <div class="navbar-profile">
            <img class="img-xs rounded-circle" src="img/profile_photo/<?php echo $user_photo ?>" alt="">
            <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $user_username ?></p>
            <i class="mdi mdi-menu-down d-none d-sm-block"></i>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
          <h6 class="p-3 mb-0">Profile</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="<?php echo base_url('profile') ?>">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-pocket text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Profile</p>
              <span class="text-primary"><small class="text-light">Central id:</small> <?php echo $this->session->userdata('user_id')?></span>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="<?php echo base_url('logout') ?>">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-logout text-danger"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Log out</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <p class="p-3 mb-0 text-center">Advanced settings</p>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-format-line-spacing"></span>
    </button>
  </div>
</nav>
<!-- partial -->