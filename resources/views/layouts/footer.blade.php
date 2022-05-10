			<footer class="footer">
                © 2020 Lead Management by Fortec Solutions
            </footer>


            <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
   
    <!-- Bootstrap tether Core JavaScript -->
    <!--<script src="{{ asset('public/admin/assets/plugins/bootstrap/js/popper.min.js') }}"></script>-->
    <script src="{{ asset('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('public/admin/main/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('public/admin/main/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('public/admin/main/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('public/admin/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('public/admin/main/js/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="{{ asset('public/admin/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--morris JavaScript -->
    <script src="{{ asset('public/admin/assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/morrisjs/morris.min.js') }}"></script>

     <!-- <script type="text/javascript" src="{{ asset('public/admin/main/js/morris-data.js') }}"></script>-->
    <script type="text/javascript">
        
        Morris.Donut({
        element: 'morris-donut-left',
        data: [{
            label: "Admin",
            value: 1,

        }, {
            label: "Manager",
            value: 1
        }, {
            label: "Employee",
            value: 1
        }],
        resize: true,
        colors:['#009efb', '#55ce63', '#2f3d4a']
    });


        Morris.Donut({
        element: 'morris-donut-right',
        data: [
        {
            label: "Total Leads",
            value: {{ $totalLeads }}
        },
        {
            label: "Pending Leads",
            value: {{ $totalPendingLeads }},

        }, {
            label: "Closed Leads",
            value: {{ $totalClosedLeads }}
        }, {
            label: "Failed Leads",
            value: {{ $totalFailedLeads }}
        }
        ],
        resize: true,
        colors:['#55ce63','#009efb', '#55ce63', '#2f3d4a']
    });


        // Morris bar chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90,
            c: 60
        }, {
            y: '2007',
            a: 75,
            b: 65,
            c: 40
        }, {
            y: '2008',
            a: 50,
            b: 40,
            c: 30
        }, {
            y: '2009',
            a: 75,
            b: 65,
            c: 40
        }, {
            y: '2010',
            a: 50,
            b: 40,
            c: 30
        }, {
            y: '2011',
            a: 75,
            b: 65,
            c: 40
        }, {
            y: '2012',
            a: 100,
            b: 90,
            c: 40
        }],
        xkey: 'y',
        ykeys: ['a', 'b', 'c'],
        labels: ['A', 'B', 'C'],
        barColors:['#55ce63', '#2f3d4a', '#009efb'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });

    

    </script>



    <!-- Chart JS -->
    <script src="{{ asset('public/admin/main/js/dashboard1.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('public/admin/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

    <!-- This is data table -->
    <script src="{{ asset('public/admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>

    <!-- Plugin JavaScript -->

    <script src="{{ asset('public/admin/assets/plugins/moment/moment.js') }}"></script>

    <script src="{{ asset('public/admin/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script>
    // MAterial Date picker    
    $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
    $('#min-date').bootstrapMaterialDatePicker({ minDate: new Date(), time: false });
    </script>

    <script>
        function goBack() {
          window.history.back();
        }

         function reloadPage() {
            location.reload();
        }

    </script>