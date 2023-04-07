     <!-- jquery -->
     <script src="<?php echo base_url()?>jquery/jquery-3.5.1.min.js"></script>
     <!-- end of jquery -->
<script src="<?php echo base_url('datatables/cdnjs.cloudflare.com_ajax_libs_jquery_3.3.1_jquery.min.js') ?>"></script>
<script src="<?php echo base_url('datatables/cdn.datatables.net_1.12.1_js_jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('datatables/cdn.datatables.net_1.12.1_js_dataTables.bootstrap4.min.js') ?>"></script>

<!-- using swal.fire() -->
<script src="<?php echo base_url() ?>assets/js/sweetalert2.js"></script>

<!-- using swal() -->
<script src="<?php echo base_url() ?>assets/js/another_sweet_alert.js"></script>



<script>
  $(document).ready(function() {
    $('#my-table').DataTable({
      // dom: '<"top"i>rt<"bottom"flp><"clear">',
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, 100, -1],
		[10, 25, 50, 100, "All"]
      ],
      //responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Enter search text"
      },

      //scrollY: "50vh",
      //scrollX: true,

    });
  });
</script>

<?php echo $this->session->flashdata('form');
$this->session->set_flashdata('form', ''); ?>