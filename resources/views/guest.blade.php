<?php
    $cat = \App\Category::orderBy('name','asc')->get();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Jimmy Parker">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('/images') }}/favicon.png" sizes="16x16" type="image/png">
    <title>TDH Online Bid Submission</title>
    <!-- Custom styles for this template -->
    <link href="{{ url('/css') }}/bootstrap.css" rel="stylesheet">
    <link href="{{ url('/css') }}/font-awesome.css" rel="stylesheet">
    <link href="{{ url('/css') }}/loader.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/plugins/bootstrap-editable/css/bootstrap-editable.css') }}">
    @yield('css')

    <style>
        fieldset {
            margin-top: 12px;
            border: 1px solid #39c;
            padding: 0px 12px;
            -moz-border-radius: 8px;
            border-radius: 8px;
        }
        legend {
            color: #39c;
            font-style: italic;
            padding-left: 12px;
            padding-right: 12px;
            font-size:0.9em;
            width: auto !important;
        }
        .badge {
            padding:3px 4px;
            font-size: 0.7em;
            font-weight: normal;
        }
    </style>
</head>

<body>
<div id="loader-wrapper">
    <div id="loader"></div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><font class="text-yellow"> Online Bid</font> Submission</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item {{ ($menu=='home') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item dropdown {{ ($menu=='manage') ? 'active':'' }}">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fa fa-cubes"></i> Bid Categories
                    </a>
                    <div class="dropdown-menu">
                        @foreach($cat as $c)
                        <a class="dropdown-item" href="{{ url('/category/show/'.$c->id) }}"><i class="fa fa-dot-circle-o"></i> {{ $c->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item {{ ($menu=='track') ? 'active':'' }}">
                    <a class="nav-link" href="#track_modal" data-toggle="modal"><i class="fa fa-line-chart"></i> Track</a>
                </li>
                <li class="nav-item {{ ($menu=='upcoming') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('/upcoming') }}"><i class="fa fa-archive"></i> Upcoming Events</a>
                </li>
                <li class="nav-item {{ ($menu=='bdocs') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-book"></i> BDocs</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Header -->
<header class="bg-success py-3 mb-5">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-12">
                <div class="banner mt-5">
                    <img src="{{ url('/images') }}/banner.png" alt="" class="img-fluid">
                </div>
            </div
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="wrapper pb-5">
    <div class="container">
        <div class="loading"></div>
        @yield('body')
    </div>
</div>
@include('modal.track')
@yield('modal')
<!-- /.container -->
<!-- Footer -->
<footer class="py-md-3 bg-dark footer">
    <div class="container">
        <font class="text-white">Copyright &copy; TDH iHOMP 2020</font>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ url('/js') }}/jquery.min.js"></script>
<script src="{{ url('/js') }}/bootstrap.bundle.min.js"></script>
<script src="{{ url('/plugins/bootstrap-editable/js/bootstrap-editable.min.js') }}"></script>
@yield('js')

<script>
    $(document).ready(function(){

        $(".btn-upload").click(function(){
            $("#loader-wrapper").css('visibility','visible');
            $(this).addClass('disabled');
        });
    });
</script>
{{--@include('script.analytics')--}}
</body>

</html>
