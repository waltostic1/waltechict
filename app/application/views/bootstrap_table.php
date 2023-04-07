<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https: //cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">


</head>
<style>
    div.dataTables_wrapper {
        width: auto;
        margin: 0 auto;
    }

    table td {
        padding: 3px !important;
        border: 1px solid white !important;
    }
</style>

<body>

    <div class="container">
        

        <table class="alert-info p-0" style="width:100%">
            <tr>
                <td colspan="2">
                    <div class="bg-warning p-2">
                <h1>BitNitro Cryptocurrency Mining Company <a href="#" class="float-right h5 p-2">Logout</a></h1>
                </div>
                </td>
            </tr>
            <tr>

                <td style="min-width:200px ;vertical-align: top;">

                    <?php $this->load->view('txn_nav.php') ?>
                </td>
                <td>
                    <div class=" p-2">

                        <table id="my-table" class="display table nowrap table-striped table-box table-bordered table-active " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    
                                  
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <td>Doris Wilder</td>
                                    <td>Sales Assistant</td>
                                    <td>Sydney</td>
                                    <td>23</td>
                                    
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </td>
                
            </tr>
            <tr><td colspan="2" class="bg-dark text-light p-2">copyright@bitnitro.com</td></tr>
        </table>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#my-table').DataTable({
                    // dom: '<"top"i>rt<"bottom"flp><"clear">',
                    "pagingType": "full_numbers",
                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"]
                    ],
                    //responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Enter search records"
                    },

                    scrollY: "60vh",
                    //scrollX: true,

                });
            });
        </script>

    </div>
</body>


</html>