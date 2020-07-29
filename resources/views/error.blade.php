@extends('guest')

@section('css')
    <style>
        .error-page {
            width: 600px;
            margin: 20px auto 0 auto;
        }
        .error-page>.headline {
            float: left;
            font-size: 100px;
            font-weight: 300;
        }
        .error-page>.error-content {
            margin-left: 190px;
            display: block;
        }
        .error-page>.error-content>h3 {
            font-weight: 300;
            font-size: 25px;
        }
    </style>
@endsection

@section('body')
    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Not found.</h3>

            <p>
                We could not find that you were looking for.
                Meanwhile, you may <a href="{{ url('/') }}">return to homepage</a>.
            </p>
        </div>
        <!-- /.error-content -->
    </div>
@endsection

@section('js')

@endsection
