@extends('app')

@section('css')
    <link href="{{ url("/plugins/chart.js/dist/Chart.min.css") }}" rel="stylesheet">
    <style>
        #loader-wrapper { visibility: visible; }
    </style>
@endsection

@section('body')
    <h2 class="text-success title-header">Welcome, <small class="text-muted">Admin</small></h2>

    <div class="col-md-12">
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
    @include('data.activity')
@endsection
