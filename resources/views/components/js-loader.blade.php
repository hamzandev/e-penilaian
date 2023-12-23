<!-- Libs JS -->
@toastifyJs
<!-- jQuery -->
<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Page specific script -->
<script>
    $(function() {
        $("#datatable").DataTable({
            "pageLength": 5,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "buttons": ["csv", "excel", "pdf", "print", ],
            "lengthMenu": [ [5, 10, 50, -1], [5, 10, 50, "All"] ]
        }).buttons().container().appendTo('.test-1');
        // Here
    });
</script>
<script src="{{ asset('assets/assets/sweetalert2/sweetalert2.all.min.js') }}" defer></script>
<!-- Tabler Core -->
<script src="{{ asset('assets/js/demo-theme.min.js?1695847769') }}" defer></script>
<script src="{{ asset('assets/js/tabler.min.js?1695847769') }}" defer></script>
<script src="{{ asset('assets/js/demo.min.js?1695847769') }}" defer></script>
