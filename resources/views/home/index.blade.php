@extends('guest')

@section('css')
    <link href="{{ url('/plugins/fullcalendar/lib/main.css') }}" rel="stylesheet" />
    <style>

    </style>
@endsection

@section('body')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        @for($i=2;$i<=78;$i++)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block" src="{{ url('/slides/Slide1.jpg') }}" alt="" style="width: 100%;">
                        </div>
                        @for($i=1;$i<=78;$i++)
                        <div class="carousel-item" style="background-size: cover;">
                            <img src="{{ url('/slides/Slide'.$i.'.jpg') }}" alt="" style="width: 100%;">
                        </div>
                        @endfor
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header">
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
