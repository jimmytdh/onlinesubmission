@extends('app')

@section('css')

@endsection

@section('body')
    <h2 class="text-success title-header">Title <small class="text-muted">Sub</small></h2>
    <div class="row">
        <div class="col-lg-12">
            <form action="" class="form-inline">
                <div class="form-group">
                    <button data-target="#stockin" data-backdrop="static" data-toggle="modal" type="button" class="btn-success btn btn-flat mr-1"><i class="fa fa-download"></i> Stock-In</button>
                </div>
                <div class="form-group">
                    <button class="btn-danger btn btn-flat mr-1" type="button"><i class="fa fa-upload"></i> Stock-Out</button>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Search..." class="form-control mr-1">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-flat">
                        <i class="fa fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>

    </div>
    @if(session('status')=='saved')
        <div class="alert alert-success">
            <i class="fa fa-check"></i> Successfully saved!
        </div>
    @endif
    <section class="content">
        <div class="table-responsive-sm">
            <table class="table table-sm table-striped mt-2">
                <tr>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Qty</th>
                    <th>Date Updated</th>
                </tr>
            </table>
        </div>
    </section>
@endsection

@section('modal')

@endsection

@section('js')

@endsection
