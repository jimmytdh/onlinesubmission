@extends('app')

@section('css')
    <link href="{{ url("/plugins/chart.js/dist/Chart.min.css") }}" rel="stylesheet">
    <link href="{{ url("/plugins/chart.js/dist/Chart.min.css") }}" rel="stylesheet">
    <link href="{{ url("/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}" rel="stylesheet">
    <link href="{{ url("/plugins/bootstrap-wysihtml5/additional.css") }}" rel="stylesheet">
    <style>
        #loader-wrapper { visibility: visible; }

        .pad .dropdown-menu {
            padding: 0.5rem 0;
            margin: 0.125rem 0 0;
            font-size: 0.9em;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 0.25rem;
        }

        .pad .dropdown-menu a {
            text-decoration: none;
        }
        .pad .dropdown-menu li {
            padding:3px;
        }

        .pad .dropdown-menu li:hover, .dropdown-menu li:focus {
            color: #16181b;
            text-decoration: none;
            background-color: #b8b9ba;
        }
    </style>
@endsection

@section('body')
    <h2 class="text-success title-header">Welcome, <small class="text-muted">Admin</small></h2>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md 12">
                @include('inc.messages')
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">BULLETIN
                            <small>Simple and fast</small>
                        </h3>
                        <!-- tools box -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        <form action="{{ url("/admin/bulletin") }}" method="post">
                        {{ csrf_field() }}
                        <textarea class="textarea" name="bulletin" placeholder="Place some text here"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {!! \App\Http\Controllers\admin\HomeCtrl::getBulletin() !!}
                        </textarea>
                            <button class="btn btn-success pull-right" type="submit">
                                <i class="fa fa-newspaper-o"></i> Update Bulletin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <!-- AREA CHART -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Last 7 days activity</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="areaChart" style="height:250px"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ \App\Http\Controllers\admin\HomeCtrl::countOpenBid() }}</h3>
                        <p class="font-weight-bold text-white">Bid Open</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="{{ url('admin/category') }}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>

                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ \App\Http\Controllers\admin\HomeCtrl::countSubmittedBid() }}</h3>
                        <p class="font-weight-bold text-white">
                            Bid Submitted
                            <br>
                            {{ date('M d, Y') }}
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="{{ url('admin/report/submission') }}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
                <div class="small-box bg-success text-white">
                    <div class="inner">
                        <center>
                            {!! $log->activity !!}
                            <br />
                            <small>{{ date('M d, Y h:i A',strtotime($log->created_at)) }}</small>
                        </center>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('js')
    <script src="{{ url('/plugins/chart.js/dist/Chart.js') }}"></script>
    <script src="{{ url('/plugins/chart.js/dist/utils.js') }}"></script>
    <script src="{{ url('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ url('/plugins/bootstrap-wysihtml5/override.js') }}"></script>

    @include('data.activity')
    <script>
        $(function () {
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        });
    </script>
@endsection
