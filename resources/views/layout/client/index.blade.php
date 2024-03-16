<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title>
        @yield('title')
    </title>
    <base href="{{asset('')}}" />
    <link rel="shortcut icon" href="images/header/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>       
        @font-face {
            font-family: HyundaiSansHeadBold;
            src: url('fonts/HyundaiSansHead-Bold.otf');
        }

        @font-face {
            font-family: HyundaiOfficeBold;
            src: url('fonts/HyundaiSansText-Bold.otf');
        }

        @font-face {
            font-family: HyundaiOfficeRegular;
            src: url('fonts/HyundaiSansText-Regular.otf');
        }
        
        .hyundai-headFont {
            font-family: "HyundaiSansHeadBold", cursive, sans-serif;
        }

        .hyundai-normalfont {
            font-family: "HyundaiOfficeRegular", cursive, sans-serif;
        }

        .hyundai-boldfont {
            font-family: "HyundaiOfficeBold", cursive, sans-serif;
        }
        #oz-scroll {
            position:fixed;
            bottom:80px;
            right:-80px;
            height:48px;
            width:48px;
            overflow:hidden;
            display:none;
            zoom:1;
            filter:alpha(opacity=60);
            opacity:.6;
            -webkit-transition:all .5s ease-in-out;
            -moz-transition:all .5s ease-in-out;
            -ms-transition:all .5s ease-in-out;
            -o-transition:all .5s ease-in-out;
            transition:all .5s ease-in-out;
        }
        #oz-scroll img {max-width:100%}
        #oz-scroll:hover {opacity:1}
        .iconScroll {background-image:url("{{asset('images/scroll/style3.png')}}");}


        /* Bông tuyết */
        .snowflake {
            color: #fff;
            font-size: 1em;
            font-family: Arial, sans-serif;
            text-shadow: 0 0 5px #000;
        }

        .snowflake,
        .snowflake .inner {
        animation-iteration-count: infinite;
        animation-play-state: running;
        }
        @keyframes snowflakes-fall {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(110vh);
        }
        }
        @keyframes snowflakes-shake {
        0%,
        100% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(80px);
        }
        }
        .snowflake {
        position: fixed;
        top: -10%;
        z-index: 9999;
        -webkit-user-select: none;
        user-select: none;
        cursor: default;
        animation-name: snowflakes-shake;
        animation-duration: 3s;
        animation-timing-function: ease-in-out;
        }
        .snowflake .inner {
        animation-duration: 10s;
        animation-name: snowflakes-fall;
        animation-timing-function: linear;
        }
        .snowflake:nth-of-type(0) {
        left: 1%;
        animation-delay: 0s;
        }
        .snowflake:nth-of-type(0) .inner {
        animation-delay: 0s;
        }
        .snowflake:first-of-type {
        left: 10%;
        animation-delay: 1s;
        }
        .snowflake:first-of-type .inner,
        .snowflake:nth-of-type(8) .inner {
        animation-delay: 1s;
        }
        .snowflake:nth-of-type(2) {
        left: 20%;
        animation-delay: 0.5s;
        }
        .snowflake:nth-of-type(2) .inner,
        .snowflake:nth-of-type(6) .inner {
        animation-delay: 6s;
        }
        .snowflake:nth-of-type(3) {
        left: 30%;
        animation-delay: 2s;
        }
        .snowflake:nth-of-type(11) .inner,
        .snowflake:nth-of-type(3) .inner {
        animation-delay: 4s;
        }
        .snowflake:nth-of-type(4) {
        left: 40%;
        animation-delay: 2s;
        }
        .snowflake:nth-of-type(10) .inner,
        .snowflake:nth-of-type(4) .inner {
        animation-delay: 2s;
        }
        .snowflake:nth-of-type(5) {
        left: 50%;
        animation-delay: 3s;
        }
        .snowflake:nth-of-type(5) .inner {
        animation-delay: 8s;
        }
        .snowflake:nth-of-type(6) {
        left: 60%;
        animation-delay: 2s;
        }
        .snowflake:nth-of-type(7) {
        left: 70%;
        animation-delay: 1s;
        }
        .snowflake:nth-of-type(7) .inner {
        animation-delay: 2.5s;
        }
        .snowflake:nth-of-type(8) {
        left: 80%;
        animation-delay: 0s;
        }
        .snowflake:nth-of-type(9) {
        left: 90%;
        animation-delay: 1.5s;
        }
        .snowflake:nth-of-type(9) .inner {
        animation-delay: 3s;
        }
        .snowflake:nth-of-type(10) {
        left: 25%;
        animation-delay: 0s;
        }
        .snowflake:nth-of-type(11) {
        left: 65%;
        animation-delay: 2.5s;
        }

        /* Bông tuyết */
        /* Noel chạy ngang */
        .santa {
            position: fixed;
            bottom: -50px;
            right: -500px;
        }
        .santa img {
            width: 500px;
            height: auto;
        }

    </style>
    <link rel="stylesheet" href="{{asset('')}}{{mix('css/appclient.css')}}" />
    @yield('local_css')
</head>
<body>
@include('layout.client.header')
@yield('content')
@include('layout.client.footer')
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5ae0471b5f7cdf4f05339854/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<a id="oz-scroll" class="iconScroll" href="#"></a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{asset('js/oz-scroll-up.js')}}"></script>
<script src="{{asset('')}}{{mix('js/appclient.js')}}"></script>
@yield('local_script')
<script type="text/javascript">
$(document).ready(function() {
    //     var windowWidth = $(document).width();
    //     var santa = $(".santa");
    //     santa_right_pos = windowWidth + santa.width();
    //     santa.right = santa_right_pos;
    //     function movesanta(){
    //         santa.animate({right : windowWidth +  santa.width()},15000, function(){
    //             santa.css("right","-500px");
    //             setTimeout(function(){
    //                 movesanta();
    //                 }, 10000);
    //         });
    //     }
    // movesanta();
});
</script>
</body>
</html>