<!DOCTYPE html>
<html>

<head>
    <title>Employee Data</title>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    @include('sweetalert::alert')

    @yield('content')

    @stack('scripts')
</body>

</html>
