@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
    <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $title }}</a>
        </div>
    </nav>

        <div id="dashboard" class="mx-3 mt-3 m-4">
          <div id='calendar' style="width: 80%"></div>

            <script>
              var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        events:'/bookingCalendar',
                        // events: [
                        //     {
                        //         title: 'Event 1',
                        //         start: dayjs('2023-12-10T10:00:00').toISOString(),
                        //         end: dayjs('2023-12-10T12:00:00').toISOString()
                        //     },
                        //     {
                        //         title: 'Event 2',
                        //         start: dayjs('2023-12-15T14:00:00').toISOString(),
                        //         end: dayjs('2023-12-15T16:00:00').toISOString()
                        //     },
                        // ],
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        eventTimeFormat: { 
                            hour: '2-digit',
                            minute: '2-digit',
                            meridiem: false
                        },
                        eventClick: function(info) { // Handle event click
                            alert('Event: ' + info.event.title+', Start: '+info.event.start+', Start time : '+dayjs(info.event.start_time).toISOString().toLocaleString("en-US",options.day)+',End Booking : '+dayjs(info.event.end_booking).toISOString().toLocaleString("en-US",options.day));
                            // You can add more logic here
                        }
                    });

                    calendar.render();
                });
            </script>
        </div>

        

        
    </div>
  </div>
@endsection
