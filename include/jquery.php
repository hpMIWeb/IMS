<script src="./assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="./assets/plugins/select2/js/select2.full.min.js"></script>

<!-- ChartJS -->
<script src="./assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./assets/plugins/moment/moment.min.js"></script>
<script src="./assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- AdminLTE App  -->
<script src="./assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./assets/dist/js/demo.js"></script>

<script src="./assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Toastr -->
<script src="./assets/plugins/toastr/toastr.min.js"></script>


<script>
    //Initialize Select2 Elements
    $('.select2').select2()

    function toast_success(msg) {
        console.log(msg)

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.success(msg);
    }

    // @Author: Pinank Soni
    // @use:  toaste pop up display
    // @this : error pop up

    function toast_error(msg) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.error(msg);
    }

    // @Author: Pinank Soni
    // @use:  toaste pop up display
    // @this : warring  pop up

    function toast_warning(msg) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.warning(msg);
    }

    // @Author: Pinank Soni
    // @use:  toaste pop up display
    // @this : info  pop up

    function toast_info(msg) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.info(msg);
    }

    function displayViewAmountDigit(amount, digit = 2) {
        Number = parseFloat(amount);
        return Number.toFixed(digit);
    }

    function isNotNullOrEmptyOrZero(str) {
        return str !== "" && str !== "0";
    }

    /**
     * @auther Pinank Soni
     *@use: Only Allow digit Allow in Amount
     */

    $(document).on('input', '.allowOnlyDigit', function(event) {
        var $this = $(this);

        // Regular expression to allow only digits and up to two decimal places
        var regex = /^\d*\.?\d{0,2}$/;

        if (!regex.test($this.val())) {
            // Remove any non-digit characters
            $this.val($this.val().replace(/[^\d.]/g, ''));

            // Ensure up to two decimal places
            if ($this.val().indexOf('.') !== -1) {
                var parts = $this.val().split('.');
                if (parts[1].length > 2) {
                    parts[1] = parts[1].substring(0, 2);
                }
                $this.val(parts.join('.'));
            }
        }
    });


    /**
     * @auther Pinank Soni
     *@use: Reset and initiate Datatable
     */
    function resetDataTable(tableName) {
        $("#" + tableName).DataTable({
            paging: true,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
            responsive: true,
            "bDestroy": true
        });
    }
</script>