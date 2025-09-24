@extends('layouts.counselor-master')

@section('body')

<section class="animated fadeInRight">
    <div class="m-b-md">
        <div class="border-bottom white-bg page-heading" id="appointmentHead">
            <div class="col-lg-12">
                <h2 class="appointment-title"><i class="fa fa-suitcase"></i> Appointment</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('counselor.dashboard') }}">Dashboard</a>
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
                <div class="ibox-title">
                    <h5>My Appointments</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Appointment Time</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->student->name ?? 'N/A' }}</td>
                                    <td>{{ $appointment->appointment_time->format('M d, Y h:i A') }}</td>
                                    <td>{{ $appointment->reason }}</td>
                                    <td>
                                        <span class="badge {{ $appointment->statusBadgeClass() }}" style="cursor:pointer;" data-toggle="modal" data-target="#appointmentModal" data-id="{{ $appointment->id }}" data-student="{{ $appointment->student->name ?? 'N/A' }}" data-time="{{ $appointment->appointment_time->format('M d, Y h:i A') }}" data-reason="{{ $appointment->reason }}" data-status="{{ $appointment->status }}" data-notes="{{ $appointment->notes ?? '' }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="note-preview note-full animated" data-full="{{ $appointment->notes }}">
                                            {{ \Illuminate\Support\Str::limit($appointment->notes, 20, '...') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Student</th>
                                    <th>Appointment Time</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Appointment Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Update Appointment</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <form id="appointmentForm">
                @csrf
                <input type="hidden" name="id" id="modal-appointment-id">

                <div class="modal-body">
                    <p><strong>Student:</strong> <span id="modal-student"></span></p>
                    <p><strong>Time:</strong> <span id="modal-time"></span></p>
                    <p><strong>Reason:</strong> <span id="modal-reason"></span></p>

                    <div class="form-group">
                        <label for="modal-notes"><strong>Notes:</strong></label>
                        <textarea class="form-control" name="notes" id="modal-notes" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label><strong>Status:</strong></label><br>
                        <button type="button" class="btn btn-primary" data-status="approved">Accept</button>
                        <button type="button" class="btn btn-danger" data-status="rejected">Reject</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('style')
<style>
    body {
        font-family: 'Poppins', sans-serif !important;
    }

    h2 {
        font-weight: 700;
    }

    #appointmentHead {
        overflow: hidden;
        border-radius: 12px !important;
    }

    .ibox {
        border-radius: 12px !important;
        overflow: hidden;
    }

    th,
    td {
        color: #676a6c;
        font-size: 1rem;
    }

    th {
        font-weight: 600;
    }

    .appointment-title {
        display: inline-flex;
        align-items: center;
        transition: color 0.3s ease, transform 0.3s ease;
        cursor: pointer;
        color: #676a6c;
        /* default text color */
    }

    .appointment-title i {
        margin-right: 8px;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .appointment-title:hover {
        color: #1ab394;
        transform: scale(1.05);
    }

    .appointment-title:hover i {
        color: #1ab394;
        transform: rotate(15deg);
    }

</style>
@endpush

@push('scripts')
<script>
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

    $(document).ready(function() {
        // DataTable
        var table = $('.dataTables-example').DataTable({
            order: []
            , pageLength: 10
            , responsive: true
            , dom: '<"html5buttons"B>lTfgitp'
            , buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });

        // Fill modal
        $('#appointmentModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            $('#modal-appointment-id').val(button.data('id'));
            $('#modal-student').text(button.data('student'));
            $('#modal-time').text(button.data('time'));
            $('#modal-reason').text(button.data('reason'));
            $('#modal-notes').val(button.data('notes'));
        });

        // Expand notes
        $('.dataTables-example tbody').on('click', '.note-preview', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var fullNote = $(this).data('full') || '-';

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child('<div style="padding:10px; color:#676a6c;"><strong>Notes:</strong><br>' + fullNote + '</div>').show();
                tr.addClass('shown');
            }
        });

        // Ajax update
        $('#appointmentForm button').click(function() {
            var status = $(this).data('status');
            var id = $('#modal-appointment-id').val();
            var notes = $('#modal-notes').val();
            var token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route("counselor.appointments.update") }}'
                , type: 'POST'
                , data: {
                    _token: token
                    , id: id
                    , status: status
                    , notes: notes
                }
                , success: function(response) {
                    var row = $('span[data-id="' + id + '"]').closest('tr');

                    row.find('td:nth-child(5) span')
                        .text(status.charAt(0).toUpperCase() + status.slice(1))
                        .removeClass('badge-primary badge-danger badge-warning')
                        .addClass(
                            status == 'approved' ? 'badge-primary' :
                            status == 'rejected' ? 'badge-danger' :
                            'badge-warning'
                        );

                    row.find('td:nth-child(6) span')
                        .text(notes.length > 20 ? notes.substring(0, 20) + '...' : notes)
                        .data('full', notes);

                    $('#appointmentModal').modal('hide');

                    // SweetAlert modal
                    Swal.fire({
                        icon: 'success'
                        , title: 'Appointment Updated!'
                        , text: 'The appointment has been updated successfully.'
                        , confirmButtonText: 'OK'
                    });
                }
                , error: function(xhr) {
                    // SweetAlert modal for errors
                    Swal.fire({
                        icon: 'error'
                        , title: 'Error!'
                        , text: 'Something went wrong while updating the appointment.'
                        , confirmButtonText: 'OK'
                    });
                    console.log(xhr.responseText);
                }
            });
        });

    });

</script>
@endpush
