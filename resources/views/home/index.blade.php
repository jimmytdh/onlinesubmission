@extends('guest')

@section('css')
    <link href="{{ url('/plugins/fullcalendar/lib/main.css') }}" rel="stylesheet" />
    <link href="{{ url("/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}" rel="stylesheet">
    <link href="{{ url("/plugins/bootstrap-wysihtml5/additional.css") }}" rel="stylesheet">
    <style>

    </style>
@endsection

@section('body')

    <div class="col-md-12">
{{--        <h2 class="text-success title-header">Welcome, <small class="text-muted">Guest</small></h2>--}}
        <div class="row">
            <div class="col-md-8" style="font-size: 1.2em;">
                <div class="p-2">
                    {!! \App\Http\Controllers\HomeCtrl::getBulletin() !!}
                </div>

            </div>
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <i class="fa fa-calendar"></i> Upcoming Events
                    </div>
                    <div class="box-body">
                        <div id='loading'>loading...</div>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('js')
    <script src="{{ url('/plugins/fullcalendar/lib/main.js') }}"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: ''
                },

                views: {
                    listDay: { buttonText: 'list day' },
                    listWeek: { buttonText: 'list week' }
                },

                initialView: 'listWeek',

                displayEventTime: true, // don't show the time column in list view

                // THIS KEY WON'T WORK IN PRODUCTION!!!
                // To make your own Google API key, follow the directions here:
                // http://fullcalendar.io/docs/google_calendar/
                googleCalendarApiKey: 'AIzaSyCsDg00xfTdNdUCNJjXMkjv56o26M_z4Es',

                // CSMC Events
                events: 'kitei8vujtasf67efrsnsn3l0c@group.calendar.google.com',
                eventClick: function(arg) {
                    // opens events in a popup window
                    //window.open(arg.event.url, 'google-calendar-event', 'width=700,height=600');

                    arg.jsEvent.preventDefault() // don't navigate in main tab
                },

                loading: function(bool) {
                    document.getElementById('loading').style.display =
                        bool ? 'block' : 'none';
                }

            });
            calendar.render();
        });

    </script>
@endsection
