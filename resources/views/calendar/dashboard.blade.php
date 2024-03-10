@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
    <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Kalender</a>
        </div>
    </nav>

        <div id="dashboard" class="mx-3 mt-3 m-4">
          <div id='calendar' style="width: 100%"></div>

            <script>
              var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        events:'/bookingCalendar',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: ''
                        },
                        eventTimeFormat: { 
                            hour: '2-digit',
                            minute: '2-digit',
                            meridiem: false
                        },
                        eventClick: function(info) {
                            window.location.href = "/booking/detail/"+info.event.extendedProps.subbook_id;
                        },
                        slotDuration: '00:30:00',
                        slotLabelFormat:{
                            hour:'2-digit',
                            minute:'2-digit',
                            hour12:false
                        }
                    });

                    calendar.render();
                });
            </script>
        </div>

        

        
    </div>
  </div>
@endsection
