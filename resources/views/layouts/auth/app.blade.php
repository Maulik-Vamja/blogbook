<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href=" {{ asset('public/assets/backend/img/favicon/faviconn.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('public/assets/backend/img/favicon/faviconn.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title')-{{ config('app.name', 'Laravel') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href=" {{ asset('public/assets/backend/css/bootstrap.min.css') }} " rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="  {{ asset('public/assets/backend/css/material-dashboard.css') }} " rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href=" {{ asset('public/assets/backend/css/demo.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href=" {{ asset('public/assets/backend/css/font-awesome.css') }}" rel="stylesheet" />
    <link href=" {{ asset('public/assets/backend/css/google-roboto-300-700.css') }}" rel="stylesheet" />
    
</head>

<body>
    @include('layouts.auth.nav')
    @yield('content')
</body>

</body>
<!--   Core JS Files   -->

<script src="{{ asset('public/assets/backend/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('public/assets/backend/js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/backend/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('public/assets/backend/js/jquery.validate.min.js') }}"></script>

<!--  DataTables.net Plugin    -->
<script src="{{ asset('public/assets/backend/js/jquery.datatables.js') }}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{ asset('public/assets/backend/js/material-dashboard.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });

        function setFormValidation(id) {
        $(id).validate({
            errorPlacement: function(error, element) {
                $(element).parent('div').addClass('has-error');
            }
        });
    }

    $(document).ready(function() {
        setFormValidation('#RegisterValidation');
        setFormValidation('#TypeValidation');
        setFormValidation('#LoginValidation');
        setFormValidation('#RangeValidation');
    });


        var table = $('#datatables').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });

        $('.card .material-datatables label').addClass('form-group');
    });
</script>
</html>