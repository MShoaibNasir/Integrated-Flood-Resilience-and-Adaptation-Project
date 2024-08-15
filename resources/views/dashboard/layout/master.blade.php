@include('dashboard.layout.header')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
<style>
      .form_width {
            padding-left: 3.5rem !important;
        }
</style>
@yield('content')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
<script>
        let table = new DataTable('#myTable');
    </script>
@include('dashboard.layout.footer')