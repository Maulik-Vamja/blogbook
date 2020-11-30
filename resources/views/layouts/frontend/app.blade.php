<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href=" {{ asset('public/assets/frontend/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('public/assets/frontend/img/logo/minicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')-{{ config('app.name', 'Laravel') }}</title>

<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" /> --}}
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<!-- CSS Files -->
<link href="{{ asset('public/assets/frontend/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/frontend/css/material-kit.css') }}" rel="stylesheet"/>
<link href="{{ asset('public/assets/frontend/assets-for-demo/demo.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/frontend/slider/owl.carousel.min.css') }}" rel="stylesheet"/> 
<link href="{{ asset('public/assets/backend/css/axios-loader.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/backend/css/notiflix-2.1.2.css') }}" rel="stylesheet">
<style>
    *{
        scroll-behavior: smooth;
    }
</style>
</head>
<body>


@stack('css')
    <!--     *********     HEADER    *********      -->

@if (Request::is('/'))
    @include('layouts.frontend.partial.header_home')
@else
    @include('layouts.frontend.partial.header')
@endif


<!--     *********    END HEADER      *********      -->

    <!-- slider -->
    
    <!-- slider end -->

    <!-- Post Container -->

   @yield('content')

    <!-- Post Container -->

    <!--     *********    SIMPLE SOCIAL LINE     *********      -->

    @include('layouts.frontend.partial.social')

    <!--     *********   SIMPLE SOCIAL LINE     *********      -->

    <!--     *********    IMAGE SUBSCRIBE LINE     *********      -->

    @include('layouts.frontend.partial.subscriber')

    <!--     *********   IMAGE SUBSCRIBE LINE     *********      -->

    <!--     *********    BIG FOOTER     *********      -->

    @include('layouts.frontend.partial.footer')

    <!--     *********   END BIG FOOTER     *********      -->
</body>
<!--   Core JS Files   -->
<script src="{{ asset('public/assets/frontend/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/frontend/js/material.min.js') }}"></script>

<script src="{{ asset('public/assets/frontend/slider/owl.carousel.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>

<!--    Plugin for Date Time Picker and Full Calendar Plugin   -->
<script src="{{ asset('public/assets/frontend/js/moment.min.js') }}" type="text/javascript"></script>

<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/   -->
<script src="{{ asset('public/assets/frontend/js/nouislider.min.js') }}" type="text/javascript"></script>

<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker   -->
<script src="{{ asset('public/assets/frontend/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select   -->
<script src="{{ asset('public/assets/frontend/js/bootstrap-selectpicker.js') }}" type="text/javascript"></script>

<!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/   -->
<script src="{{ asset('public/assets/frontend/js/bootstrap-tagsinput.js') }}"></script>

<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput   -->
<script src="{{ asset('public/assets/frontend/js/jasny-bootstrap.min.js') }}"></script>

<!--    Plugin For Google Maps   -->
<script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
<script src="{{ asset('public/assets/frontend/js/material-kit.js?v=1.2.1') }}" type="text/javascript"></script>
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
        Notiflix.Confirm.Init({ messageColor:"#0e0e0e",messageFontSize:"15px",okButtonBackground:"#e91e63",backOverlayColor:"rgba(0,0,0,0.54)",width:"240px" }); 
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
                        
                        $('#followers-show-action').html(data.data)
                    }
                    window.location.reload();
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

    

    $(document).on('keyup','#postSearch',function(event){
        event.preventDefault();
        let data = $('#postInputSearch').val();
        axios.get("{{ route('search') }}",{
            params : {
                title : data
            }
        }).then(data => {
            $('#searchPostResult').html(data.data)
        }).catch(error => {
            console.log(error)
        })
    });

    $(document).on('keyup','#authorSearch',function(event){
            event.preventDefault();
            let data = $('#authorSearchInput').val();
            axios.get("{{ route('author_search') }}",{
                params : {
                    name : data
                }
            }).then(data => {
                $('#authorSearchResult').html(data.data)
            }).catch(error => {
                console.log(error)
            })
            });

    var header_height;
    var fixed_section; 
    var floating = false;

    $().ready(function(){
        suggestions_distance = $("#suggestions").offset();
        pay_height = $('.fixed-section').outerHeight();

        $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);

        // the body of this function is in assets/material-kit.js
        materialKit.initSliders();
        materialKit.initFormExtendedDatetimepickers();
    });

    $('.owl-carousel').owlCarousel({
    autoplay:1000,
    loop:true,
    margin:10,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
$(document).ready (function(){
    window.setTimeout(function() {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000); });
</script>

@stack('js')
</html>
