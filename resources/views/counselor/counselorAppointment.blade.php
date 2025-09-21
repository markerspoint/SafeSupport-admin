@extends('layouts.counselor-master')

<style>
    #appointmentHead {
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

    th,
    td {
        color: #676a6c;
    }

</style>

@section('body')

<section class="animated fadeInDown">

    <div class="m-b-md">
        <div class="border-bottom white-bg page-heading" id="appointmentHead">
            <div class="col-lg-12">
                <h2>Appointment</h2>
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
                                    <th>ID</th>
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
                                    <td>{{ $appointment->id }}</td>
                                    <td>{{ $appointment->student->name ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y h:i
                                            A') }}</td>
                                    <td>{{ $appointment->reason }}</td>
                                    <td>
                                        <span class="badge 
                                                @if($appointment->status == 'accepted') badge-primary 
                                                @elseif($appointment->status == 'rejected') badge-danger 
                                                @else badge-warning @endif" style="cursor:pointer;" data-toggle="modal" data-target="#appointmentModal" data-id="{{ $appointment->id }}" data-student="{{ $appointment->student->name ?? 'N/A' }}" data-time="{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y h:i A') }}" data-reason="{{ $appointment->reason }}" data-status="{{ $appointment->status }}" data-notes="{{ $appointment->notes ?? '' }}">
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
                                    <th>ID</th>
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
    <div class="modal-dialog modal-lg">
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
                        <label for="modal-notes">Notes</label>
                        <textarea class="form-control" name="notes" id="modal-notes" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label><br>
                        <button type="button" class="btn btn-primary" data-status="accepted">Accept</button>
                        <button type="button" class="btn btn-danger" data-status="rejected">Reject</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

    $(document).ready(function() {
        // Initialize DataTable only once
        var table = $('.dataTables-example').DataTable({
            order: [],
            pageLength: 10, 
            responsive: true, 
            dom: '<"html5buttons"B>lTfgitp', 
            buttons: [{
                    extend: 'copy'
                }
                , {
                    extend: 'csv'
                }
                , {
                    extend: 'excel'
                    , title: 'ExampleFile'
                }
                , {
                    extend: 'pdf'
                    , title: 'ExampleFile'
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

        // Fill modal with appointment data
        $('#appointmentModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            $('#modal-appointment-id').val(button.data('id'));
            $('#modal-student').text(button.data('student'));
            $('#modal-time').text(button.data('time'));
            $('#modal-reason').text(button.data('reason'));
            $('#modal-notes').val(button.data('notes'));
        });

        // Handle note click -> expand child row
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
    });


    // ajax
    $(document).ready(function() {
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
                            status == 'accepted' ? 'badge-primary' :
                            status == 'rejected' ? 'badge-danger' :
                            'badge-warning'
                        );

                    row.find('td:nth-child(6) span').text(notes.length > 20 ? notes.substring(0, 20) + '...' : notes);

                    $('#appointmentModal').modal('hide');

                    toastr.success('Appointment updated successfully!');
                }
                , error: function(xhr) {
                    toastr.error('Something went wrong.');
                    console.log(xhr.responseText);
                }
            });
        });
    });

</script>
@endsection
