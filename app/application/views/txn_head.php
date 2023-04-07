<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>


<link rel="stylesheet" href="<?php echo base_url('datatables/cdn.datatables.net_1.12.1_css_dataTables.bootstrap4.min.css') ?>">
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> -->

<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/css/vendor.bundle.base.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Ruda:400,900,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="<?php echo base_url()?>assets/images/favicon.jpeg" />

<!-- using swal.fire() -->
<script src="<?php echo base_url() ?>assets/js/sweetalert2.js"></script>

<!-- using swal() -->
<script src="<?php echo base_url() ?>assets/js/another_sweet_alert.js"></script>


<style>
  div.dataTables_wrapper {
    width: auto;
    margin: 0 auto;
  }

  table td {
    padding: 0px !important;
    /* border: 1px solid lightcoral !important; */
  }
</style>

<?php $this->load->view('admin_login_check');

?>