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
                <table class="table table-striped">
                    <?php
                    $sub = \App\Http\Controllers\HomeCtrl::submission($ref_no);
                    ?>
                    <tr>
                        <th colspan="2">
                            Financial, Technical and Eligibility Files
                        </th>
                    </tr>
                    @foreach($sub as $s)
                        <tr>
                            <td>
                                @if($s->status=='original')
                                    <span class="text-green">ORIGINAL COPY</span>
                                @else
                                    <span class="text-red">MODIFICATION</span>
                                @endif
                            </td>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($s->created_at)) }}
                            </td>
                        </tr>
                    @endforeach

                    @if($project->status=='open' && $project->date_open <= \Carbon\Carbon::now())
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-success btn-block btn-lg btn-modify no-print" data-target="#modify_modal" data-toggle="modal" data-id="{{ $info->id }}">
                                Submit Modified Files
                            </button>
                        </td>
                    </tr>
                    @else
                        <tr class="bg-red">
                            <td colspan="2" class="text-white text-center no-print">
                                <h4>CLOSE</h4>
                            </td>
                        </tr>
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
    </script>
@endsection
