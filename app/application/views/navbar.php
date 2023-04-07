<?php
$this->load->view('login_check');
//require('login_session.php');

if($get_user_info->num_rows()>0){
  foreach($get_user_info->result()as $row){
    $username=$row->username;
    $fullName=$row->full_name;
    $email=$row->email;
    $phone=$row->phone;
    $upliner=$row->ref_username;
    $status=$row->status;
    $loginToken=$row->login_token;
    $photo=$row->photo;
    $totalAmount=$row->total_amount;

  }
}
?>

<!-- partial:partials/_navbar.html -->
<nav class="navbar p-0 fixed-top d-flex flex-row">
  <div class="p-1 col-12">
    <p></p>
  </div>
  <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
    
    <a class="navbar-brand brand-logo-mini text-light font-weight-bolder text-center" href="../view">
      <!--<img src="assets/images/logo-mini.svg" alt="logo" />-->Bitnitro
    </a>
  </div>
  <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
    <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav w-100">
      <li class="nav-item w-100">
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      
      <li class="nav-item dropdown border-left">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
          <!-- <i class="mdi mdi-account-group mdi-24px "></i> -->          
           <span class="h6">Sys-Token</span><br><span class="text-success h6"> $<?=number_format($totalAmount)?></span> 
        </a>
        
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <h6 class="p-3 mb-0">Your Sys-Token balance is <span class="text-success h5">$<?=$totalAmount?></span></h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="<?php echo base_url('make_withdrawal') ?>">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="  mdi mdi-cash-100  text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Withdraw</p>
              <!-- <p class="text-muted ellipsis mb-0"> Update dashboard </p> -->
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="<?php echo base_url('make_deposit') ?>">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="  mdi mdi-cash-100  text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Deposit</p>
              <!-- <p class="text-muted ellipsis mb-0"> Update dashboard </p> -->
            </div>
          </a>



          <div class="dropdown-divider"></div>
          <p class="p-3 mb-0 text-center">See all notifications</p>
        </div>
      </li>



      <li class="nav-item dropdown border-left border-right">
        <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
          <div class="navbar-profile">
            <img class="img-xs rounded-circle" src="img/profile_photo/<?php echo $photo ?>" alt="">
            <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $username ?></p>
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
  <!-- google traslator div-->
  <div class="col-12 container">
  <div id="google_translate_element"></div>
  </div>
  <!-- end of google traslator div -->


<!-- google translator script -->
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<!-- end of google translator script -->

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- partial -->
</nav>