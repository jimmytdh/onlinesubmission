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
                            <th>Date Submitted</th>
                            <th>Items</th>
                            <th class="text-center">Financial File</th>
                            <th class="text-center">Technical File</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        <?php $holder = '';?>
                        @foreach($info as $row)
                            <?php
                                $itemsBidded = \App\Http\Controllers\admin\ItemCtrl::getItemByBid($row->id);
                            ?>
                            <tr>
                                <td class="box-title">
                                    @if($holder!=$row->ref_no)
                                    <a href="#remarks_modal" data-toggle="modal" data-bid_id="{{ $row->id }}" data-remarks="{{ $row->remarks }}" data-status="{{ $row->final_status }}">
                                    <span class="badge badge-pill badge-info p-2">
                                        <i class="fa fa-barcode"></i> {{ $row->ref_no }}
                                    </span>
                                    </a>
                                    @endif
                                </td>
                                <td>@if($holder!=$row->ref_no){{ $row->company }}@endif</td>
                                <td>@if($holder!=$row->ref_no){{ $row->bidder }}
                                    <br>
                                    <small class="text-danger">{{ $row->contact }}</small>@endif
                                </td>
                                <td>{{ date('M d, Y',strtotime($row->created_at)) }}
                                    <br>
                                    <small class="text-danger">{{ date('h:i A',strtotime($row->created_at)) }}</small>
                                </td>
                                <td>
                                    <ul class="list-unstyled">
                                        @foreach($itemsBidded as $i)
                                        <li>{{ $i->item_no }}. {{ $i->name }}</li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td class="text-center">
                                    @if(isset($row->financial_file))
                                    <a href="{{ asset('/storage/upload/'.$row->financial_file) }}">
                                    <span class="badge badge-pill badge-info p-2 m-1">
                                        <i class="fa fa-download"></i> Original <br>
                                        <small>{{ date('m/d/y h:i a',strtotime($row->date_financial)) }}</small>
                                    </span>
                                    </a>
                                    @endif

                                    @if(isset($row->mfinancial_file))
                                        <a href="{{ asset('/storage/upload/'.$row->mfinancial_file) }}">
                                            <span class="badge badge-pill badge-success p-2 m-1">
                                                <i class="fa fa-download"></i> Modified <br>
                                                <small>{{ date('m/d/y h:i a',strtotime($row->date_mfinancial)) }}</small>
                                            </span>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(isset($row->technical_file))
                                        <a href="{{ asset('/storage/upload/'.$row->technical_file) }}">
                                    <span class="badge badge-pill badge-info p-2 m-1">
                                        <i class="fa fa-download"></i> Original <br>
                                        <small>{{ date('m/d/y h:i a',strtotime($row->date_technical)) }}</small>
                                    </span>
                                        </a>
                                    @endif

                                    @if(isset($row->mtechnical_file))
                                        <a href="{{ asset('/storage/upload/'.$row->mtechnical_file) }}">
                                            <span class="badge badge-pill badge-success p-2 m-1">
                                                <i class="fa fa-download"></i> Modified <br>
                                                <small>{{ date('m/d/y h:i a',strtotime($row->date_mtechnical)) }}</small>
                                            </span>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($holder!=$row->ref_no)
                                        @if($row->final_status=='passed')
                                        <span class="badge badge-pill badge-success p-2">
                                            <i class="fa fa-check"></i> Passed
                                        </span>
                                        @elseif($row->final_status=='failed')
                                        <span class="badge badge-pill badge-danger p-2">
                                            <i class="fa fa-times"></i> Failed
                                        </span>
                                        @else
                                        <span class="badge badge-pill badge-warning p-2">
                                            <i class="fa fa-hourglass"></i> Pending
                                        </span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <?php $holder = $row->ref_no;?>
                        @endforeach
                    </table>
                </div>
            @else
                @if($notfound)
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
    @include('modal.remarks')
@endsection

@section('js')
<script>
    $('a[href="#remarks_modal"]').on('click',function(){
            $('.loading_content').removeClass('hidden');
            $('.main_content').addClass('hidden');
            var status = $(this).data('status');
            var remarks = $(this).data('remarks');
            var bid_id = $(this).data('bid_id');
            setTimeout(function(){
                $('.loading_content').addClass('hidden');
                $('.main_content').removeClass('hidden');

                $('#status').val(status);
                $('#remarks').val(remarks);
                $('#bid_id').val(bid_id);
            },500);
    });
</script>
@endsection
