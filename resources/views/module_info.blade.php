<!DOCTYPE html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="{{ Config::get('general.author') }}"/>
    <meta name="keywords" content="{{ Config::get('general.keywords') }}"/>
    <meta name="description" content="{{ Config::get('general.description') }}"/>

    <title>
        @section('title')
            {{ Config::get('general.title') }}
        @show
    </title>

    <link rel="shortcut icon" href="{{ asset('ico/favicon.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="57x57"
          href="{{ asset('ico/apple-touch-icon-57-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{ asset('ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ asset('ico/apple-touch-icon-144-precomposed.png') }}">

    <!-- ------------------------------------------ Google Fonts ------------------------------------------ -->
    <!--
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
    -->

    <!-- ------------------------------------------ CSS stylesheets ------------------------------------------ -->

    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/bootstrap-3.3.5-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/font-awesome-4.3.0/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/illuminate3/css/standard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">

</head>

<body>


@include($activeTheme . '::' . '_partials.navigation')

<div class="container-fluid">
    <!-- <div id="wrap" class="container"> -->
    @include($activeTheme . '::' . '_partials.content')
</div><!-- ./container -->

@include($activeTheme . '::' . '_partials.footer')

        <!-- ------------------------------------------ js ------------------------------------------ -->

<script type="text/javascript" src="{{ asset('assets/vendors/jquery/jquery-2.1.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-3.3.5-dist/js/bootstrap.min.js') }}"></script>

</body>
</html>
