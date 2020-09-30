@extends('app')

@section('css')
    <style>
        .table {
            font-size: 0.9em;
        }
    </style>
@endsection

@section('body')
    <h3 class="text-success title-header">BAC No.: <span class="text-danger">{{ $proj->bac_no }}</span></h3>
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
            <h5><i class="icon fa fa-exclamation"></i> Oppss! Duplicate Entry!</h5>
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">
            @if(!$edit)
                <div class="box box-info bg-info">
                    <div class="box-header text-white font-weight-bold">
                        <i class="fa fa-plus"></i> Add Item
                    </div>
                    <form action="{{ url('admin/items/list/'.$id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <select name="project_id" id="project_id" class="form-control">
                                    @foreach($projects as $pr)
                                        <option value="{{ $pr->id }}" @if($pr->id==$id) selected @endif>{{ $pr->bac_no }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" min="1" autocomplete="off" class="form-control" placeholder="Item No." required name="item_no">
                            </div>
                            <div class="form-group">
                                <input type="text" autocomplete="off" class="form-control" placeholder="Item Name" required name="name">
                            </div>
                            <div class="form-group">
                                <input type="text" autocomplete="off" class="form-control" placeholder="Unit" required name="unit">
                            </div>
                            <div class="form-group">
                                <input type="number" autocomplete="off" class="form-control" placeholder="Amount" required name="amount">
                            </div>
                            <div class="form-group">
                                <input type="number" autocomplete="off" class="form-control" placeholder="QTY" required name="qty">
                            </div>
                        </div>
                        <div class="box-footer bg-info">
                            <button class="btn btn-warning btn-block" type="submit">
                                <i class="fa fa-check"></i> Save
                            </button>
                            <a href="{{ url('/admin/projects/list/'.$proj->cat_id) }}" class="btn btn-block btn-default">
                                <i class="fa fa-arrow-left"></i> Project List
                            </a>
                        </div>
                    </form>
                </div>
            @else
                <div class="box box-warning bg-warning">
                    <div class="box-header font-weight-bold">
                        <i class="fa fa-plus"></i> Update Item
                    </div>
                    <form action="{{ url('/admin/items/update/'.$info->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <select name="project_id" id="project_id" class="form-control">
                                        @foreach($projects as $pr)
                                            <option value="{{ $pr->id }}" @if($pr->id==$id) selected @endif>{{ $pr->bac_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" min="1" value="{{ $info->item_no }}" autocomplete="off" class="form-control" placeholder="Item No." required name="item_no">
                                </div>
                                <div class="form-group">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="Item Name" value="{{ $info->name }}" required name="name">
                                </div>
                                <div class="form-group">
                                    <input type="text" autocomplete="off" value="{{ $info->unit }}" class="form-control" placeholder="Unit" required name="unit">
                                </div>
                                <div class="form-group">
                                    <input type="number" autocomplete="off" class="form-control" placeholder="Amount" value="{{ $info->amount }}" required name="amount">
                                </div>
                                <div class="form-group">
                                    <input type="number" autocomplete="off" class="form-control" placeholder="QTY" value="{{ $info->qty }}" required name="qty">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success btn-block" type="submit">
                                <i class="fa fa-check"></i> Update
                            </button>
                            <a href="{{ url('/admin/items/delete/'.$info->id) }}" class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                            <a href="{{ url('/admin/items/list/'.$id) }}" class="btn btn-block btn-default">
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
                                <th>Item</th>
                                <th>Unit</th>
                                <th>Amount</th>
                                <th>Qty</th>
                            </tr>
                            </thead>
                            @if(count($data)>0)
                                @foreach($data as $row)
                                    <tr>
                                        <td class="text-aqua">
                                            <a href="{{ url('/admin/items/edit/'.$row->id) }}">
                                                <strong>{{ $row->item_no }}. {{ $row->name }}</strong>
                                            </a>
                                        </td>
                                        <td>{{ $row->unit }}</td>
                                        <td>{{ number_format($row->amount,2) }}</td>
                                        <td>{{ $row->qty }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-warning text-center">
                                            No items available!
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
        $('#project_id').on('change',function(){
            var id = $(this).val();
            window.location.href = "{{ url('/admin/items/list') }}/" + id;
        });
    </script>
@endsection
