@extends('app')

@section('css')
    <style>
        upd {
            color: #f9b02d;
        }
        rm {
            color: #ff4730;
        }
        add {
            color: #14802c;
        }
    </style>
@endsection

@section('body')
    <h2 class="text-success title-header">System Logs</h2>

    <div class="col-md-12">
        <table class="table table-hover table-striped table-sm">
            @if(count($logs)>0)
                @foreach($logs as $row)
                <tr>
                    <td>{{ date('M d, Y',strtotime($row->created_at)) }}</td>
                    <td>{{ date('h:i A',strtotime($row->created_at)) }}</td>
                    <td>{!! $row->activity !!}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No logs</td>
                </tr>
            @endif
        </table>
        {{ $logs->links() }}
    </div>
@endsection

@section('js')

@endsection
