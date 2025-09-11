@extends('layouts.counselor-master')

<style>
    #schedHead {
        overflow: hidden;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        border-radius: 12px !important;
    }

    .ibox {
        overflow: hidden;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        border-radius: 12px !important;
    }

    .ibox:hover {
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .fc-button {
        background: #fff !important;
        color: #676a6c !important;
        font-weight: 500;

        box-shadow: none !important;
        text-shadow: none !important;
        background-image: none !important;
    }

    .fc-dayGridMonth-button.fc-button-active,
    .fc-timeGridWeek-button.fc-button-active,
    .fc-timeGridDay-button.fc-button-active {
        background: #1ab394 !important;
        color: #fff !important;
        border-color: #1ab394 !important;
    }

</style>

@section('body')
<section>

    <div class="m-b-md">
        <div class="border-bottom white-bg page-heading" id="schedHead">
            <div class="col-lg-12">
                <h2>Schedule</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('counselor.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Schedule</strong>
                    </li>
                </ol>
            </div>
        </div>
    </div>


    <div class="row animated fadeInDown">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Draggable Events</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id='external-events'>
                        <p>Drag a event and drop into callendar.</p>
                        <div class='external-event navy-bg'>Go to shop and buy some products.</div>
                        <div class='external-event navy-bg'>Check the new CI from Corporation.</div>
                        <div class='external-event navy-bg'>Send documents to John.</div>
                        <div class='external-event navy-bg'>Phone to Sandra.</div>
                        <div class='external-event navy-bg'>Chat with Michael.</div>
                        <p class="m-t">
                            <input type='checkbox' id='drop-remove' class="i-checks" checked /> <label for='drop-remove'>remove after drop</label>
                        </p>
                    </div>
                </div>
            </div>
            <div class="ibox ">
                <div class="ibox-content">
                    <h2>talaposon!!!1</h2> talaposon.
                    <p>
                        <a href="m.me/mrkn.ide" target="_blank">Mark Ian</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Striped Table </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green'
            , radioClass: 'iradio_square-green'
        });

        /* initialize the external events
         -----------------------------------------------------------------*/


        $('#external-events div.external-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999
                , revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

        });


        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today'
                , center: 'title'
                , right: 'month,agendaWeek,agendaDay'
            }
            , editable: true
            , droppable: true, // this allows things to be dropped onto the calendar
            eventColor: '#1ab394'
            , drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            }
            , events: [{
                    title: 'All Day Event'
                    , start: new Date(y, m, 1)
                }
                , {
                    title: 'Long Event'
                    , start: new Date(y, m, d - 5)
                    , end: new Date(y, m, d - 2)
                }
                , {
                    id: 999
                    , title: 'Repeating Event'
                    , start: new Date(y, m, d - 3, 16, 0)
                    , allDay: false
                }
                , {
                    id: 999
                    , title: 'Repeating Event'
                    , start: new Date(y, m, d + 4, 16, 0)
                    , allDay: false
                }
                , {
                    title: 'Meeting'
                    , start: new Date(y, m, d, 10, 30)
                    , allDay: false
                }
                , {
                    title: 'Lunch'
                    , start: new Date(y, m, d, 12, 0)
                    , end: new Date(y, m, d, 14, 0)
                    , allDay: false
                }
                , {
                    title: 'Birthday Party'
                    , start: new Date(y, m, d + 1, 19, 0)
                    , end: new Date(y, m, d + 1, 22, 30)
                    , allDay: false
                }
                , {
                    title: 'Click for Google'
                    , start: new Date(y, m, 28)
                    , end: new Date(y, m, 29)
                    , url: 'http://google.com/'
                }
            ]
        });

    });

</script>

@endsection
