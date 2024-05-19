    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('../../admin/assets/node_modules/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('../../admin/assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('../../admin/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('../../admin/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('../../admin/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('../../admin/js/custom.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="{{asset('../../admin/assets/node_modules/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('../../admin/assets/node_modules/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('../../admin/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- Popup message jquery -->
    <script src="{{asset('../../admin/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
    <!-- jQuery peity -->
    <script src="{{asset('../../admin/assets/node_modules/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('../../admin/assets/node_modules/peity/jquery.peity.init.js')}}"></script>
    <script src="{{asset('../../admin/js/dashboard1.js')}}"></script>
    
<script src="https://cdn.datatables.net/v/bs4/dt-1.13.7/datatables.min.js"></script>
<script src="https://cdn.datatables.net/v/bs4/dt-1.13.7/datatables.min.js"></script>
<!-- This is data table -->
<script src="{{ asset('../../assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('../../assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>

<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function () {
            $('#myTable').DataTable();
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            $('#example23').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ]
            });
            $('.buttons-pdf, .buttons-excel').addClass('btn btn-primary me-1');
                    // Export to Excel
            $('#exportExcel').on('click', function () {
                $('#example').DataTable().button('.buttons-excel').trigger();
            });

            // Export to PDF
            $('#exportPdf').on('click', function () {
                $('#example').DataTable().button('.buttons-pdf').trigger();
            });
    });
</script>
