@extends('app')

@section('css')
    <style>
        .error-page>.headline {
            float: left;
            font-size: 100px;
            font-weight: 300;
        }
        .error-page>.error-content {

            display: block;
        }
        .error-page>.error-content>h3 {
            font-weight: 300;
            font-size: 25px;
        }
    </style>
@endsection

@section('body')
    <h2 class="text-success title-header">Submission <small class="text-muted">Report</small></h2>

    <div class="col-md-12">
        <form action="{{ url('/admin/report/submission') }}" method="post">
            {{ csrf_field() }}
        <div class="row">
            <div class="input-group mb-3">
                <input type="text" class="form-control" autofocus required value="{{ $bac_no }}" name="bac_no" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Input BAC No.">
                <div class="input-group-append">
                    <button class="btn btn-info" type="submit">
                        <i class="fa fa-search"></i> Find Now
                    </button>
                </div>
            </div>
            @if($info)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-dark text-white">
                        <tr>
                            <th>Ref. No.</th>
                            <th>Company</th>
                            <th>Representative</th>
                            <th>Contact</th>
                            <th class="text-center">Financial File</th>
                            <th class="text-center">Technical File</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        @foreach($info as $row)
                            <tr>
                                <td class="box-title">
                                    <a href="#checklist_modal" data-toggle="modal">
                                    <span class="badge badge-pill badge-info p-2">
                                        <i class="fa fa-barcode"></i> {{ $row->ref_no }}
                                    </span>
                                    </a>
                                </td>
                                <td>{{ $row->company }}</td>
                                <td>{{ $row->bidder }}</td>
                                <td>{{ $row->contact }}</td>
                                <td class="text-center">
                                    <a href="{{ url('/admin/report/submission/download/financial/'.$row->id) }}">
                                    <span class="badge badge-pill badge-info p-2">
                                        <i class="fa fa-file-zip-o"></i> Download
                                    </span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('/admin/report/submission/download/technical/'.$row->id) }}">
                                    <span class="badge badge-pill badge-warning p-2">
                                        <i class="fa fa-file-zip-o"></i> Download
                                    </span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if($row->final_status=='pass')
                                    <span class="badge badge-pill badge-success p-2">
                                        <i class="fa fa-check"></i> Pass
                                    </span>
                                    @elseif($row->final_status=='fail')
                                    <span class="badge badge-pill badge-danger p-2">
                                        <i class="fa fa-times"></i> Fail
                                    </span>
                                    @else
                                    <span class="badge badge-pill badge-warning p-2">
                                        <i class="fa fa-hourglass"></i> Pending
                                    </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                @if(session('status')=='notfound')
                    <div class="error-page">
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Not found.</h3>

                            <p>
                                We could not find that you were looking for.
                                Please try again.
                            </p>
                        </div>
                        <!-- /.error-content -->
                    </div>
                @else
                    <div class="alert alert-info col-sm-12">
                        <h5>
                            Please input valid BAC No. above to start viewing the submission.
                        </h5>
                    </div>
                @endif
            @endif
        </div>
        </form>
        <!-- /.row -->
    </div>
@endsection

@section('modal')
    @include('modal.checklist')
@endsection

@section('js')

@endsection
