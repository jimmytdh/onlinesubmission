@extends('guest')

@section('css')
    <link href="{{ url('/plugins/fullcalendar/lib/main.css') }}" rel="stylesheet" />
@endsection

@section('body')
    <h2 class="text-success title-header">Upcoming Events</h2>
    <div class="col-md-12">
        <div id='loading'>loading...</div>
        <div id='calendar1'></div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/plugins/fullcalendar/lib/main.js') }}"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar1');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listYear'
                },

                displayEventTime: false, // don't show the time column in list view

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
