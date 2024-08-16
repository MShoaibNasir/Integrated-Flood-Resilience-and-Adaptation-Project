@include('dashboard.layout.header')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
<style>
    .form_width {
        padding-left: 3.5rem !important;
    }

    .back_button {
        background-color: rgba(51, 51, 51, 0.05);
        border-radius: 8px;
        border-width: 0;
        color: #333333;
        cursor: pointer;
        display: inline-block;
        font-family: "Haas Grot Text R Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
        list-style: none;
        margin: 0;
        padding: 10px 12px;
        text-align: center;
        transition: all 200ms;
        vertical-align: baseline;
        white-space: nowrap;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .create_button {
        background-image: linear-gradient(#0dccea, #0d70ea);
        border: 0;
        border-radius: 4px;
        box-shadow: rgba(0, 0, 0, .3) 0 5px 15px;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        font-family: Montserrat, sans-serif;
        font-size: .9em;
        margin: 5px;
        padding: 10px 15px;
        text-align: center;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }
    a:hover {
    color: white;
}
</style>
@yield('content')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
</script>
@include('dashboard.layout.footer')