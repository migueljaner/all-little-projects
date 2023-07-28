<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>@yield('title')</title>
        
        <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="language" content="{{Session::get('lang')}}">
        <base href="{{ url()->current() }}">

        <!--Metas para compartir en Facebook-->
        <!--<meta property="og:title" content="Captive Portal" />
        <meta property="og:description" content="Descripción de la página" />
        <meta property="og:image" content="https://www.anuttarayoga.com/wp-content/uploads/2016/12/free-wifi.png" />      
        <meta property="og:url" content="https://portaldev.p.w34marketing.com/captive-portal/e2b11b93-e26f-4b96-afbd-00e228e8a1c1" />-->

        <link rel="icon" href="/images/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <!-- Scripts -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
            <script src="{{ asset('components/jquery.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('components/semantic-ui/semantic.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('semantic-ui-calendar/calendar.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/ajax.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/modals.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/public.js') }}" type="text/javascript"></script>
            @include('layouts.subLayouts.public.dataView')
            @include('public.captive-portal.dataView')

        <!--^^ Scripts ^^-->
        <!-- Styles -->

            <!-- <link href="{{ asset('css/public.css') }}" rel="stylesheet" type="text/css"> -->
            <link href="{{ asset('components/semantic-ui/semantic.min.css') }}" rel="stylesheet" type="text/css">
            <link href="{{ asset('semantic-ui-calendar/calendar.min.css') }}" rel="stylesheet" type="text/css">
            <link href="{{ asset('css/captive-portal.css') }}" rel="stylesheet" type="text/css">

        <!--^^ Styles ^^-->

        @yield('head')

    </head>
    <body>

        <div id="structure">

            <div id="content">
                @yield('content')
            </div>

            @include('public.captive-portal.modals')

        </div>

    </body>
    
</html>