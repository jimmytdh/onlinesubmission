@extends('app')

@section('css')
<link rel="stylesheet" href="{{ url('/plugins/autocomplete/style.css') }}" />
<style>
    #loader-wrapper { visibility: visible; }
    .table a { text-decoration: none; }
</style>
@endsection

@section('body')
    <h2 class="text-success title-header">Supply <small class="text-muted">Panel</small></h2>
    <section class="content">
        <div class="table-responsive-sm">
            <div class="row mb-2">
                <div class="col-lg-12">
                    <form action="{{ url('/supply') }}" class="form-inline" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" placeholder="Search..." value="{{ Session::get('searchSupply') }}" name="search" class="form-control mr-1">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-flat mr-1">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                        <div class="form-group">
                            <button data-target="#stockin" data-backdrop="static" data-toggle="modal" type="button" class="btn-success btn btn-flat mr-1"><i class="fa fa-download"></i> Stock-In</button>
                        </div>
                        <div class="form-group">
                            <button class="btn-danger btn btn-flat mr-1" type="button"><i class="fa fa-upload"></i> Stock-Out</button>
                        </div>
                    </form>
                </div>

            </div>
            @if(session('status')=='saved')
            <div class="alert alert-success">
                <i class="fa fa-check"></i> Successfully saved!
            </div>
            @endif

            @if(count($data)>0)
            <table class="table table-sm table-striped table-bordered mt-2">
                <thead>
                    <tr class="bg-dark text-white">
                        <th>Supply</th>
                        <th>Unit</th>
                        <th>Qty</th>
                        <th>Date Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <?php
                        $qty = \App\Stocks::where('supply_id',$row->id)->sum('qty');
                        $updated =\App\Stocks::where('supply_id',$row->id)->orderBy('updated_at','desc')->first();
                        if($updated){
                            $updated = date('M d, Y',strtotime($updated->updated_at));
                        }else{
                            $updated = '';
                        }
                    ?>
                    <tr>
                        <td class="nowrap">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-reorder"></i></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('/stock/'.$row->id) }}">
                                    <i class="fa fa-file-text"></i> View Sub Supplies
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/supply/delete/'.$row->id) }}">
                                    <i class="fa fa-trash"></i> Delete Supply
                                </a>
                            </div>
                            &nbsp;&nbsp;
                            <strong>{{ $row->name }}</strong>
                        </td>
                        <td>{{ $row->unit }}</td>
                        <td>{{ $qty }}</td>
                        <td>{{ $updated }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
            @else
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-triangle"></i> No data found!
            </div>
            @endif
        </div>
    </section>
@endsection

@section('modal')
    @include('modal.stockin')
@endsection

@section('js')
{{--    <script src="{{ url('/plugins/autocomplete/jquery.mockjax.js') }}"></script>--}}
    <script src="{{ url('/plugins/autocomplete/jquery.autocomplete.js') }}"></script>
    <script src="{{ url('/plugins/autocomplete/countries.js') }}"></script>
{{--    <script src="{{ url('/plugins/autocomplete/demo.js') }}"></script>--}}
    <script>
        $("#supplyAutocomplete").autocomplete({
            lookup: getSupplies()
        });

        $("#brandAutocomplete").autocomplete({
            lookup: getBrands()
        });

        function getSupplies() {
            var supplies;
            $.ajax({
                url: "{{ url('supply/list') }}",
                type: "GET",
                async: false,
                success: function(data){
                    supplies = data;
                    setTimeout(function () {
                        $("#loader-wrapper").css('visibility','hidden');
                    },500);
                }
            });
            return supplies;
        }

        function getBrands() {
            var brands;
            $.ajax({
                url: "{{ url('supply/brand') }}",
                type: "GET",
                async: false,
                success: function(data){
                    brands = data;
                }
            });
            return brands;
        }
    </script>
@endsection
