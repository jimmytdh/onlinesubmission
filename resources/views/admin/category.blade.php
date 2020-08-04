@extends('app')

@section('css')
    <style>
        .table {
            font-size: 0.9em;
        }
    </style>
@endsection

@section('body')
    <h3 class="text-success title-header">Manage Categories</h3>
    @if(session('status')=='save')
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Successfully added!</h5>
        </div>
    @endif
    @if(session('status')=='update')
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Successfully updated!</h5>
        </div>
    @endif
    @if(session('status')=='delete')
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Successfully deleted!</h5>
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
            @if(!$edit)
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
            @else
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-plus"></i> Update Category
                </div>
                <form action="{{ url('/admin/category/update/'.$info->id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <input type="text" value="{{ $info->name }}" autocomplete="off" class="form-control" placeholder="Category Name..." required name="categoryName">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success btn-block" type="submit">
                            <i class="fa fa-check"></i> Update
                        </button>
                        <a href="{{ url('/admin/category/delete/'.$info->id) }}" class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                        <a href="{{ url('/admin/category') }}" class="btn btn-block btn-default">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </form>
            </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-sm  table-bordered table-hover">
                            <thead class="bg-dark text-white">
                            <tr>
                                <th>Category Name</th>
                                <th>Projects</th>
                                <th>Date Added</th>
                            </tr>
                            </thead>
                            @if(count($data)>0)
                                @foreach($data as $row)
                                    <tr>
                                        <td class="text-aqua">
                                            <a href="{{ url('/admin/category/edit/'.$row->id) }}">
                                            <strong>{{ $row->name }}</strong>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?php  $count_projects = \App\Http\Controllers\admin\ProjectCtrl::countProjects($row->id); ?>
                                            <a href="{{ url('/admin/projects/list/'.$row->id) }}" class="badge badge-success badge-pill" style="padding:7px 25px;">
                                                {{ $count_projects }}
                                            </a>
                                        </td>
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
