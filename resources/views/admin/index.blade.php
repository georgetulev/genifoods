<!-- app/views/admin/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

    <script type="text/javascript" src="{{ URL::asset('vendors/js/jQuery-2.2.4.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/css/datepicker.css" />
    <script src="/js/datepicker.js"></script>
    <script src="/js/locales/datepicker.bg.js"></script>
    <script src="/js/pdfmake.js"></script>
    <script src="/js/vfs_fonts.js"></script>
    <style>
        .table tbody>tr>td {
            line-height: 32px;
        }
    </style>
</head>
    <body>
        <div class="container">

            @include('admin.navbar')

            <!-- will be used to show any messages -->
            @include('errors.list')

            @yield('content')
        </div>
        <script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.1/b-flash-1.2.1/b-html5-1.2.1/b-print-1.2.1/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.1/b-flash-1.2.1/b-html5-1.2.1/b-print-1.2.1/datatables.min.js"></script>    </body>
</html>


