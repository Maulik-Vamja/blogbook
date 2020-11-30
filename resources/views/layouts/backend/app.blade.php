<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')-{{ config('app.name', 'Laravel') }}</title>
    
    <link rel="apple-touch-icon" sizes="76x76" href=" {{ asset('public/assets/frontend/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('public/assets/frontend/img/logo/minicon.png') }}">

    <!-- Bootstrap core CSS     -->
    <link href=" {{ asset('public/assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('public/assets/backend/css/material-dashboard.css') }}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('public/assets/backend/css/demo.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="{{ asset('public/assets/backend/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/backend/css/axios-loader.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/backend/css/notiflix-2.1.2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/backend/css/google-roboto-300-700.css') }}" rel="stylesheet" />



@stack('css')

</head>
<body>

    <div class="wrapper">

        <!-- ------------  SIDEBAR START  ------------------->

        @include('layouts.backend.partial.sidebar')
        <!-- ------------  SIDEBAR END  ------------------->


        <div class="main-panel">

            <!---------------------- NAVBAR START ------------------->

            @include('layouts.backend.partial.navbar')

            <!---------------------- NAVBAR END ------------------->


            <div class="content">
            @yield('content')
            </div>
        </div>
    </div>
    
</body>

<!--   Core JS Files   -->
<script src="{{ asset('public/assets/backend/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/backend/js/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/backend/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/backend/js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/backend/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('public/assets/backend/js/jquery.validate.min.js') }}"></script>

<!--  Plugin for the Wizard -->
<script src="{{ asset('public/assets/backend/js/jquery.bootstrap-wizard.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('public/assets/backend/js/bootstrap-notify.js') }}"></script>
<!--   Sharrre Library    -->
<script src="{{ asset('public/assets/backend/js/jquery.sharrre.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/jquery.select-bootstrap.js') }}"></script>
<!-- Select Plugin -->
<script src="{{ asset('public/assets/backend/js/jquery.select-bootstrap.js') }}"></script>
<!--  DataTables.net Plugin    -->
<script src="{{ asset('public/assets/backend/js/jquery.datatables.js') }}"></script>
<!-- Sweet Alert 2 plugin -->

<!--	Plugin for Fileupload  ---------- -->
<script src="{{ asset('public/assets/backend/js/jasny-bootstrap.min.js') }}"></script>

<!-- Material Dashboard javascript methods -->
<script src="{{ asset('public/assets/backend/js/material-dashboard.js') }}"></script>
<script src="{{asset('public/assets/backend/js/jquery.tagsinput.js')}}"></script>
<script src="{{ asset('public/assets/backend/js/sweetalert2.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/demo.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/axios.min.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/axios-loader.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/notiflix-2.1.2.js') }}"></script>


<script>
    function processData(selector,action,user_id)
    {
        let user_action = '';
        let user = '';
        if(action == 'unfollow')
        {
            user_action = "Are you sure want to Unfollow it..?",
            user = "Unfollow"
        }
        else{
            user_action = "Are you sure want to follow This User..?",
            user = "Follow"
        }
        Notiflix.Confirm.Init({ messageColor:"#0e0e0e",messageFontSize:"15px",okButtonBackground:"#e91e63",backOverlayColor:"rgba(0,0,0,0.64)",width:"240px", }); 
        Notiflix.Confirm.Show('Attention',user_action,user,'Cancel',
            function(){
                axios.get("{{ route('userAction') }}",{
                    params : {
                        action : action,
                        user_id : user_id
                    }
                }).then(data => {
                    if(action=='unfollow')
                    {
                        $('#following-show-action').html(data.data)
                    }
                    else{
                        // reloadfollowers();
                        $('#followers-show-action').html(data.data)
                    }
                    reloadfollowers()
                }).catch(error => [
                    console.log(error)
                ])
            },
            function(){ 
                
            });
    }
    function reloadfollowers() {
        axios.get("{{ route('userAction') }}",{
                    params : {
                        action : 'reload-follower',
                    }
                }).then(data => {
                        $('#followers-show-action').html(data.data)
                }).catch(error => [
                    console.log(error)
                ])
    }
</script>

@stack('js')

</html>
