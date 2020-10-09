@extends('guest')

@section('css')
    <style>
        .btn-xs {
            padding: 0.25rem 0.3rem;
            font-size: 0.9rem;
            line-height: 1.0;
            border-radius: 0.2rem;
        }
        .box-widget {
            border: none;
            position: relative;
        }
        .widget-user .widget-user-username {
            margin-top: 0;
            margin-bottom: 5px;
            font-size: 25px;
            font-weight: 400;
            text-shadow: 0 1px 1px rgba(0,0,0,0.2);
        }
        .widget-user .widget-user-desc {
            margin-top: 0;
        }
        .widget-user .widget-user-header {
            padding: 20px;
            border-top-right-radius: 3px;
            border-top-left-radius: 3px;
        }
        .box-footer {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            border-top: 1px solid #f4f4f4;
            padding: 10px;
            background-color: #fff;
        }
        .description-block {
            display: block;
            margin: 10px 0;
            text-align: center;
        }
        .description-block>.description-header {
            margin: 0;
            padding: 0;
            font-weight: 600;
            font-size: 16px;
        }
        .description-block>.description-text {
            text-transform: uppercase;
            font-size: 0.8em;
            color: #e71010;
        }
        .box {
            border:2px solid #ccc;
        }

    </style>
@endsection

@section('body')
    <h2 class="text-success title-header">{{ $cat_name }}</h2>

    <div class="col-md-12">
        @if(session('status')=='nopassword')
            <div class="alert alert-danger">
                <div class="text-center">
                    <i class="fa fa-exclamation-triangle"></i> Oppps. Please put password on the archived document before upload. Thank you!
                </div>
            </div>
        @endif
        @include('inc.messages')
        <div class="row">


            @if(count($projects)>0)

                @foreach($projects as $pr)
                <div class="col-md-4">
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-yellow">
                            <h3 class="widget-user-username">BAC {{ $pr->bac_no }}</h3>
                            <a class="text-white" href="#item_modal" data-toggle="modal" data-id="{{ $pr->id }}" data-backdrop="static">
                            <h5 class="widget-user-desc"><i class="fa fa-folder-open"></i> {{ \App\Http\Controllers\HomeCtrl::countItems($pr->id) }} Item(s)</h5>
                            </a>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">₱ {{ number_format($pr->ABC) }}</h5>
                                        <span class="description-text">ABC</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ date('M d, Y',strtotime($pr->date_open)) }}</h5>
                                        <span class="description-text">{{ date('h:i A',strtotime($pr->date_open)) }}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-default btn-block btn-submit" data-backdrop="static" data-id="{{ $pr->id }}" data-target="#submit_modal" data-toggle="modal">
                                        <i class="fa fa-folder-open"></i> Submit Bid
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="alert alert-warning col-sm-12 text-center">
                    *** <i class="fa fa-exclamation-triangle"></i> No projects available! ***
                </div>
            @endif
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
        var loading = "{{ url('/loading') }}";
        $('#item_modal').on('hidden.bs.modal', function () {
            $('.loading_content').load(loading);
        });
        $('#submit_modal').on('hidden.bs.modal', function () {
            $('.loading_content').load(loading);
        });
        $("a[href='#item_modal']").on('click',function(){
            var id = $(this).data('id');
            var url = "{{ url('/project/items/') }}/"+id;
            setTimeout(function(){
                $('.loading_content').load(url);
            },500);

        });

        $(".btn-submit").on('click',function(){
            var id = $(this).data('id');
            var url = "{{ url('/submit/') }}/"+id;
            setTimeout(function(){
                $('.loading_content').load(url,function(){
                    $('input[type="text"]').attr('autocomplete','off');
                    $(".custom-file-input").on("change", function() {
                        var fileName = $(this).val().split("\\").pop();
                        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    });
                    $('#submitForm').attr('action',url);
                });
            },500);

        });

        $('#submitForm').on('submit',function(){
            $(this).find('.submit').attr('disabled',true);
            $("#loader-wrapper").css('visibility','visible');
        });
    </script>
@endsection
