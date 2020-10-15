@extends('guest')

@section('css')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #print, #print * {
                visibility: visible;
            }
            #print {
                position: absolute;
                left: 0;
                top: 0;
            }
            .no-print, .no-print *
            {
                display: none !important;
            }
        }
    </style>
@endsection

@section('body')
    <div class="col-md-12" id="print">
        <div class="text-center">
            <h2>{{ strtoupper($project->name) }} (BAC <span class="text-green">{{ $project->bac_no }}</span>)</h2>
            <h3>
                Approved Budget of the Contract (ABC): <span class="text-red">₱ {{ number_format($project->ABC,2) }}</span> <br />
                Opening of Bids : <span class="text-red">{{ date('M d, Y h:i A',strtotime($project->date_open)) }}</span>
            </h3>
        </div>
        <hr />
        <div class="no-print">
            @include('inc.messages')
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div>
                    <span class="text-red" style="font-size: 1.5em;font-weight: 500;">REF. NO. {{ $ref_no }}</span><br>
                    <span class="text-green">{{ strtoupper($info->bidder) }}</span> <br />
                    <small class="text-muted">
                        {{ strtoupper($info->company) }}<br />
                        {{ $info->contact }}
                    </small>
                </div>
                <br>
                <table class="table table-striped">
                    <tr>
                        <td>
                            <span class="font-weight-bold">Financial File</span>
                        </td>
                        <td class="text-right">
                            @if(isset($info->financial_file))
                                <span class="text-success">
                                        <i class="fa fa-check-circle"></i> {{ date('m/d/y h:ia',strtotime($info->date_financial)) }}
                                    </span>
                            @else
                                <div class="no-print">
                                    <a href="#upload_financial" data-toggle="modal" class="btn btn-sm btn-success">
                                        <i class="fa fa-upload"></i> Upload
                                    </a>
                                </div>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td><span class="font-weight-bold">Technical File</span></td>
                        <td class="text-right">
                            @if(isset($info->technical_file))
                                <span class="text-success">
                                        <i class="fa fa-check-circle"></i> {{ date('m/d/y h:ia',strtotime($info->date_technical)) }}
                                    </span>
                            @else
                                <div class="no-print">
                                    <a href="#upload_technical" data-toggle="modal" class="btn btn-sm btn-success">
                                        <i class="fa fa-upload"></i> Upload
                                    </a>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @if(isset($info->financial_file) && isset($info->technical_file))
                        <tr>
                            <td>
                                <span class="font-weight-bold">Modified Financial File</span>
                            </td>
                            <td class="text-right">
                                @if(isset($info->mfinancial_file))
                                    <span class="text-success">
                                        <i class="fa fa-check-circle"></i> {{ date('m/d/y h:ia',strtotime($info->date_mfinancial)) }}
                                    </span>
                                    @if($project->status<>'close')
                                    <a href="#upload_mfinancial" data-toggle="modal" class="btn btn-sm btn-success no-print">
                                        <i class="fa fa-upload"></i> Upload
                                    </a>
                                    @endif
                                @else
                                    <div class="no-print">
                                        <a href="#upload_mfinancial" data-toggle="modal" class="btn btn-sm btn-success">
                                            <i class="fa fa-upload"></i> Upload
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td><span class="font-weight-bold">Modified Technical File</span></td>
                            <td class="text-right">
                                @if(isset($info->mtechnical_file))
                                    <span class="text-success">
                                        <i class="fa fa-check-circle"></i> {{ date('m/d/y h:ia',strtotime($info->date_mtechnical)) }}
                                    </span>
                                    @if($project->status<>'close')
                                    <a href="#upload_mtechnical" data-toggle="modal" class="btn btn-sm btn-success no-print">
                                        <i class="fa fa-upload"></i> Upload
                                    </a>
                                    @endif
                                @else
                                    <div class="no-print">
                                        <a href="#upload_mtechnical" data-toggle="modal" class="btn btn-sm btn-success">
                                            <i class="fa fa-upload"></i> Upload
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @if($project->status=='close')
                        <tr class="no-print">
                            <td colspan="2" class="text-center bg-red" style="font-size: 1.5em;">
                                <i class="fa fa-lock"></i> Close
                            </td>
                        </tr>
                        @endif
                    @endif
                </table>
            </div>

            <div class="col-sm-6">
                <fieldset class="pb-3">
                    <legend>BAC Remarks</legend>
                    <h4 class="text-center">
                        @if($info->remarks)
                            {!! nl2br($info->remarks) !!}
                        @else
                            *** No Remarks Yet ***
                        @endif
                    </h4>
                    <hr>
                    <h1 class="text-center">
                        @if($info->final_status=='passed')
                            <span class="text-success">*** PASSED ***</span>
                        @elseif($info->final_status=='failed')
                            <span class="text-danger">*** FAILED ***</span>
                        @else
                            <span class="text-warning">*** PENDING ***</span>
                        @endif
                    </h1>
                </fieldset>
            </div>
            <!-- /.row -->
        </div>
        <hr />
        <div class="pull-right no-print">
            <button class="btn btn-default" onClick="window.print()">
                <i class="fa fa-print"></i> Print
            </button>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection


@section('modal')
    @include('modal.modify')
    @include('modal.upload')
@endsection

@section('js')
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('.btn-modify').on('click',function(){
            $('.loading_content').removeClass('hidden');
            $('.main_content').addClass('hidden');
            var id = $(this).data('id');
            setTimeout(function(){
                $('.loading_content').addClass('hidden');
                $('.main_content').removeClass('hidden');
                $('#bid_id').val(id);
            },500);
        });

        $('#submitForm').on('submit',function(){
            $(this).find('.submit').attr('disabled',true);
            $("#loader-wrapper").css('visibility','visible');
        });

        $('#financialForm').on('submit',function(){
            $(this).find('.submit').attr('disabled',true);
            $("#loader-wrapper").css('visibility','visible');
        });

        $('#technicalForm').on('submit',function(){
            $(this).find('.submit').attr('disabled',true);
            $("#loader-wrapper").css('visibility','visible');
        });

        $('#mfinancialForm').on('submit',function(){
            $(this).find('.submit').attr('disabled',true);
            $("#loader-wrapper").css('visibility','visible');
        });

        $('#mtechnicalForm').on('submit',function(){
            $(this).find('.submit').attr('disabled',true);
            $("#loader-wrapper").css('visibility','visible');
        });
    </script>
@endsection
