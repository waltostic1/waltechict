     <!-- google traslator div-->
     <div class="col-12 container">
         <div id="google_translate_element"></div>
     </div>
     <!-- end of google traslator div -->

     <!-- google translator script -->
     <script type="text/javascript">
         function googleTranslateElementInit() {
             new google.translate.TranslateElement({
                 pageLanguage: 'en'
             }, 'google_translate_element');
         }
     </script>
     <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
     <!-- end of google translator script -->




     <!-- Header -->
     <header id="header" class="header modern-header modern-header-theme-colored">
         <div class="header-top bg-theme-colored sm-text-center">
             <div class="container">
                 <div class="row">
                     <div class="col-md-8">
                         <div class="widget text-white">
                             <i class="fa fa-calendar text-theme-colored2"></i> Launch Date : <b style="color: #ffae11;">May 1, 2021</b>
                         </div>
                     </div>

                     <div class="widget">
                         <ul class="list-inline  text-right flip sm-text-center">
                             <li class="m-0 pl-10">
                                 <a href="../app/login"><i class="fa fa-user-o mr-5 text-theme-colored2"></i> Login /</a>
                             </li>
                             <li class="m-0 pl-0 pr-10">
                                 <a href="../app/register"><i class="fa fa-edit mr-5 text-theme-colored2"></i>Register</a>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
         </div>
         <div class="header-middle p-0 bg-light xs-text-center">
             <div class="container">
                 <div class="row">
                     <div class="col-xs-12 col-sm-4 col-md-3">
                         <div class="widget sm-text-center">
                             <i class="fa fa-envelope text-theme-colored2 font-32 mt-5 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
                             <a href="#" class="font-12 text-gray text-uppercase">Mail Us Today</a>
                             <h5 class="font-13 text-black m-0">
                                 <h5 class="font-13 text-black m-0"> <a href="#">helpdesk@bitnitro.com</a></h5>
                         </div>
                     </div>
                     <div class="col-xs-12 col-sm-4 col-md-6">
                         <div class="widget text-center">
                             <!-- <a class="" href="index.php"><img src="logo.jpeg" alt="BN" width="70" height="40" /></a> -->
                         </div>
                         <div class="navbar-header">
                         </div>
                     </div>
                     <div class="col-xs-12 col-sm-4 col-md-3">
                         <div class="widget sm-text-center">
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="header-nav">
             <div class="header-nav-wrapper navbar-scrolltofixed">
                 <div class="container">
                     <!-- nav here -->
                     <?php require('nav.php') ?>
                 </div>
             </div>
         </div>



     </header>



     <!-- <style>
        .preloader-dot-loading .cssload-loading i {
            width: 19px;
            height: 19px;
            display: inline-block;
            border-radius: 50%;
            background: blueviolet;;
        }
    </style>

    <div id="preloader">
        <div id="spinner">
            <div class="preloader-dot-loading">
                <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
            </div>
        </div>
        <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
    </div> -->