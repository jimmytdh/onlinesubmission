@extends('app')

@section('css')

@endsection

@section('body')
    <h3 class="text-success title-header">Manage Categories</h3>
    @if(session('status')=='save')
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-check"></i> Successfully added!</h5>
    </div>
    @endif
    @if(session('status')=='duplicate')
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-exclamation"></i> Oppss! Duplicate entry.</h5>
    </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-plus"></i> Add Category
                </div>
                <form action="{{ url('/admin/category/save') }}" method="post">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <input type="text" autocomplete="off" class="form-control" placeholder="Category Name..." required name="categoryName">
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success btn-block" type="submit">
                        <i class="fa fa-check"></i> Save
                    </button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-sm  table-bordered table-hover">
                            <thead class="">
                            <tr>
                                <th>Category Name</th>
                                <th>Projects</th>
                                <th>Date Added</th>
                            </tr>
                            </thead>
                            @if(count($data)>0)
                                @foreach($data as $row)
                                    <tr>
                                        <td class="text-aqua"><strong>{{ $row->name }}</strong></td>
                                        <td></td>
                                        <td>{{ date('M d, Y h:i a',strtotime($row->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            @else

                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
