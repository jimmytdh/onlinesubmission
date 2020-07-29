@extends('guest')

@section('css')
    <style>

    </style>
@endsection

@section('body')
    <div class="col-md-12">
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

                    @if($project->status=='open' && $project->date_open >= \Carbon\Carbon::now())
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-success btn-block btn-lg">
                                Submit Modified Files
                            </button>
                        </td>
                    </tr>
                    @else
                        <tr class="bg-red">
                            <td colspan="2" class="text-white text-center">
                                <h4>CLOSE</h4>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>

            <div class="col-sm-6">
                <fieldset class="pb-3">
                    <legend>BAC Remarks</legend>
                    @if($info->remarks)
                    {!! nl2br($info->remarks) !!}
                    @else
                    <div class="text-center">
                        *** No Remarks Yet ***
                    </div>
                    @endif
                </fieldset>
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection

@section('js')

@endsection
