@extends('app')

@section('css')
    <style>
        .table {
            font-size: 0.9em;
        }
    </style>
@endsection

@section('body')
    <h3 class="text-success title-header">Category: <span class="text-danger">{{ $cat_name }}</span></h3>
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
                <div class="box box-info bg-info">
                    <div class="box-header text-white font-weight-bold">
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
                                <input type="number" autocomplete="off" class="form-control" placeholder="ABC" required name="ABC">
                            </div>
                            <div class="form-group">
                                <input type="date" autocomplete="off" class="form-control" required name="date_open">
                            </div>
                            <div class="form-group">
                                <input type="time" autocomplete="off" class="form-control" value="09:00" required name="time_open">
                            </div>
                        </div>
                        <div class="box-footer bg-info">
                            <button class="btn btn-warning btn-block" type="submit">
                                <i class="fa fa-check"></i> Save
                            </button>
                            <a href="{{ url('/admin/category') }}" class="btn btn-block btn-default">
                                <i class="fa fa-arrow-left"></i> Category List
                            </a>
                        </div>
                    </form>
                </div>
            @else
                <div class="box box-warning bg-warning">
                    <div class="box-header font-weight-bold">
                        <i class="fa fa-plus"></i> Update Project
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
                                    <input type="time" autocomplete="off" class="form-control" value="{{ date('H:i',strtotime($info->date_open)) }}" required name="time_open">
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
                                <i class="fa fa-arrow-left"></i> Cancel
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
                                <th>BAC No.</th>
                                <th>ABC</th>
                                <th>Status</th>
                                <th>Items</th>
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

                                        <td>{{ $row->bac_no }}</td>
                                        <td>{{ number_format($row->ABC,2) }}</td>
                                        <td>
                                            @if($row->status=='open')
                                                <span class="text-success">Open</span> <small class="text-danger"><em>{{ date('M d, Y h:i a',strtotime($row->date_open)) }}</em></small>
                                            @elseif($row->status=='close')
                                                <strong><span class="text-danger">Close</span></strong>
                                                <br />
                                                {{ $row->awarded }}
                                            @endif
                                        </td>
                                        <td>
                                            <?php
                                            $count_items = \App\Http\Controllers\admin\ItemCtrl::countItems($row->id);
                                            $items = \App\Http\Controllers\admin\ItemCtrl::getItemsByProjectID($row->id);
                                            ?>
                                            <ul class="list-unstyled">
                                                @foreach($items as $i)
                                                    <li>{{ $i->item_no }}. {{ $i->name }}</li>
                                                @endforeach
                                                <li>
                                                    <a href="{{ url('/admin/items/list/'.$row->id) }}" style="border-bottom: 1px dotted #000;">
                                                        Add New
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-warning text-center">
                                        No projects available!
                                    </div>
                                </td>
                            </tr>
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
