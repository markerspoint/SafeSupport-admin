@extends('layouts.student-master')

<style>
    #profileHead {
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

    td,
    th {
        color: #676a6c;
    }

    .bootstrap-datetimepicker-widget table td.day {
        font-size: 80%;
    }

    .bootstrap-datetimepicker-widget {
        font-size: 0.8rem;
        width: 30rem !important;
    }

    .bootstrap-datetimepicker-widget table td.day,
    .bootstrap-datetimepicker-widget table th {
        font-size: 0.75rem;
    }

    Header .bootstrap-datetimepicker-widget .datepicker-switch {
        font-size: 0.8rem;
    }

    .bootstrap-datetimepicker-widget .timepicker td,
    .bootstrap-datetimepicker-widget .timepicker th {
        font-size: 0.7rem;
    }

</style>

@section('body')
<section>
    <div class="m-b-md">
        <div class="border-bottom white-bg page-heading" id="profileHead">
            <div class="col-lg-12">
                <h2>Appointments</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('student.appointment') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Appointment</strong>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Appointments</h5>
                    <button class="btn btn-primary btn-sm" style="margin-right: -4rem;" data-toggle="modal" data-target="#bookAppointmentModal">
                        <i class="fa fa-plus"></i> Book Appointment
                    </button>
                </div>

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Counselor</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody id="appointmentsTableBody">
                                @include('student.partials.appointments-table-body', ['appointments' => $appointments])
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<!-- Appointment Modal -->
<div class="modal fade" id="bookAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="bookAppointmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Book Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="appointmentForm" action="{{ route('student.appointments.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="counselor_id">Counselor</label>
                        <select name="counselor_id" id="counselor_id" class="form-control" required>
                            <option value="">-- Select Counselor --</option>
                            @foreach($counselors as $counselor)
                            <option value="{{ $counselor->id }}">{{ $counselor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="appointment_time">Select Date & Time</label>
                        <div class="input-group date" id="datetimepickerModal" data-target-input="nearest">
                            <input type="hidden" class="form-control datetimepicker-input" data-target="#datetimepickerModal" name="appointment_time" id="appointment_time" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Book</button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('scripts')
<script>
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

    $(document).ready(function() {
        var table = $('.dataTables-example').DataTable({
            pageLength: 10
            , responsive: true
            , dom: '<"html5buttons"B>lTfgitp'
            , buttons: [{
                    extend: 'copy'
                }
                , {
                    extend: 'csv'
                }
                , {
                    extend: 'excel'
                    , title: 'Appointments'
                }
                , {
                    extend: 'pdf'
                    , title: 'Appointments'
                }
                , {
                    extend: 'print'
                    , customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]
        });

        $('#appointmentForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action')
                , method: 'POST'
                , data: $(this).serialize()
                , success: function(response) {
                    $('#bookAppointmentModal').modal('hide');
                    $('#appointmentForm')[0].reset();

                    table.destroy();

                    $('#appointmentsTableBody').html(response.html);

                    table = $('.dataTables-example').DataTable({
                        pageLength: 25
                        , responsive: true
                        , dom: '<"html5buttons"B>lTfgitp'
                        , buttons: [{
                                extend: 'copy'
                            }
                            , {
                                extend: 'csv'
                            }
                            , {
                                extend: 'excel'
                                , title: 'Appointments'
                            }
                            , {
                                extend: 'pdf'
                                , title: 'Appointments'
                            }
                            , {
                                extend: 'print'
                                , customize: function(win) {
                                    $(win.document.body).addClass('white-bg');
                                    $(win.document.body).css('font-size', '10px');
                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                }
                            }
                        ]
                    });
                    toastr.success('Appointment booked successfully!');
                }
                , error: function() {
                    toastr.error('Something went wrong. Please try again.');
                }
            });
        });
    });

    $('#datetimepickerModal').datetimepicker({
        format: 'YYYY-MM-DD hh:mm A'
        , minDate: moment()
        , viewMode: 'days', // only show calendar first
        stepping: 15, // optional: increment minutes
        sideBySide: true
        , inline: true
    , });

    $('#datetimepickerModal').on('change.datetimepicker', function(e) {
        if (e.date) {
            $('#appointment_time').val(e.date.format('YYYY-MM-DD hh:mm A'));
        }
    });

</script>
@endsection

