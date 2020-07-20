@extends('app')

@section('css')
    <style>
        .table {
            font-size: 0.9em;
        }
    </style>
@endsection

@section('body')
    <h3 class="text-success title-header">{{ $cat_name }}</h3>
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
            <h5><i class="icon fa fa-exclamation"></i> Oppss! Duplicate BAC No.</h5>
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">
            @if(!$edit)
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-plus"></i> Add Project
                    </div>
                    <form action="{{ url('admin/projects/list/'.$id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <select name="cat_id" id="cat_id" class="form-control">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" @if($cat->id==$id) selected @endif>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" autocomplete="off" class="form-control" placeholder="Project Name..." required name="project_name">
                            </div>
                            <div class="form-group">
                                <input type="text" autocomplete="off" class="form-control" placeholder="BAC No." required name="bac_no">
                            </div>
                            <div class="form-group">
                                <input type="text" autocomplete="off" class="form-control" placeholder="ABC" required name="ABC">
                            </div>
                            <div class="form-group">
                                <input type="date" autocomplete="off" class="form-control" placeholder="BAC No." required name="date_open">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success btn-block" type="submit">
                                <i class="fa fa-check"></i> Save
                            </button>
                            <a href="{{ url('/admin/category') }}" class="btn btn-block btn-default">
                                <i class="fa fa-arrow-left"></i> Category List
                            </a>
                        </div>
                    </form>
                </div>
            @else
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-plus"></i> Update Category
                    </div>
                    <form action="{{ url('/admin/projects/update/'.$info->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <select name="cat_id" class="form-control">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" @if($cat->id==$id) selected @endif>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="Project Name..." value="{{ $info->name }}" required name="project_name">
                                </div>
                                <div class="form-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="BAC No." value="{{ $info->bac_no }}" required name="bac_no">
                                </div>
                                <div class="form-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="ABC" value="{{ $info->ABC }}" required name="ABC">
                                </div>
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="open" @if($info->status=='open') selected @endif>Open</option>
                                        <option value="close" @if($info->status=='close') selected @endif>Close</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="date" autocomplete="off" class="form-control" value="{{ date('Y-m-d',strtotime($info->date_open)) }}" required name="date_open">
                                </div>
                                <div class="form-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="Awarded to..." value="{{ $info->awarded }}" name="awarded">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success btn-block" type="submit">
                                <i class="fa fa-check"></i> Update
                            </button>
                            <a href="{{ url('/admin/projects/delete/'.$info->id) }}" class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                            <a href="{{ url('/admin/projects/list/'.$id) }}" class="btn btn-block btn-default">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            @endif
        </div>
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-sm  table-bordered table-hover">
                            <thead class="bg-dark text-white">
                            <tr>
                                <th>Project Name</th>
                                <th>Items</th>
                                <th>BAC No.</th>
                                <th>ABC</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            @if(count($data)>0)
                                @foreach($data as $row)
                                    <tr>
                                        <td class="text-aqua">
                                            <a href="{{ url('/admin/projects/edit/'.$row->id) }}">
                                                <strong>{{ $row->name }}</strong>
                                            </a>
                                        </td>
                                        <td>
                                            <?php  $count_projects = \App\Http\Controllers\admin\ProjectCtrl::countProjects($row->id); ?>
                                            <a href="{{ url('/admin/projects/list/'.$row->id) }}" class="">
                                                {{ $count_projects }}
                                            </a>
                                        </td>
                                        <td>{{ $row->bac_no }}</td>
                                        <td>{{ number_format($row->ABC,2) }}</td>
                                        <td>
                                            @if($row->status=='open')
                                                <span class="text-success">Open</span> <small class="text-danger"><em>{{ date('M d, Y',strtotime($row->date_open)) }}</em></small>
                                            @elseif($row->status=='close')
                                                <span class="text-success">Close</span> <small class="text-danger"><em>{{ date('M d, Y',strtotime($row->date_close)) }}</em></small>
                                                <br />
                                                {{ $row->awarded }}
                                            @endif
                                        </td>
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
    <script>
        $('#cat_id').on('change',function(){
            var id = $(this).val();
            window.location.href = "{{ url('/admin/projects/list') }}/" + id;
        });
    </script>
@endsection
