@extends('guest')

@section('css')
    <style>
        .btn-xs {
            padding: 0.25rem 0.3rem;
            font-size: 0.9rem;
            line-height: 1.0;
            border-radius: 0.2rem;
        }
    </style>
@endsection

@section('body')
    <h2 class="text-success">{{ $cat_name }}</h2>

    <div class="col-md-12">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                    <tr>
                        <th>BAC No.</th>
                        <th class="text-center">Items</th>
                        <th class="text-right">ABC</th>
                        <th class="text-center">Date Open</th>
                        <th class="text-center">Time Open</th>
                        <th class="text-center">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($projects) > 0)
                        @foreach($projects as $pr)
                            <tr>
                                <td>
                                    <a href="#submit_modal" data-toggle="modal" data-id="{{ $pr->id }}" class="">
                                        <strong>{{ $pr->bac_no }}</strong>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="#item_modal" data-toggle="modal">
                                        {{ \App\Http\Controllers\HomeCtrl::countItems($pr->id) }}
                                    </a>
                                </td>
                                <td class="text-right">
                                    ₱ {{ number_format($pr->ABC,2) }}
                                </td>
                                <td class="text-center">
                                    <small class="text-danger">{{ date('M d, Y',strtotime($pr->date_open)) }}</small>
                                </td>
                                <td class="text-center">
                                    <small class="text-danger">{{ date('h:i A',strtotime($pr->date_open)) }}</small>
                                </td>
                                <td class="text-center">
                                    @if($pr->status=='open')
                                        <strong class="text-success">Open</strong>
                                    @elseif($pr->status=='close')
                                        <strong class="text-danger">Close</strong>
                                    @else
                                        {{ strtoupper($pr->status) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">NO PROJECTS AVAILABLE</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('modal')
    @include('modal.viewItems')
    @include('modal.submit')
@endsection

@section('js')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
