@extends('layouts.student-master')

@section('body')

<section>
    {{-- tabs --}}
    <div class="mb-4 tab-wrapper p-3">
        <ul class="nav nav-tabs nav-fill" id="dashboardTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link tab-card active" id="appointments-tab" data-toggle="tab" href="#appointments" role="tab">
                    <i class="fa fa-calendar fa-2x d-block mb-2"></i>
                    <span>Appointments</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link tab-card" id="resources-tab" data-toggle="tab" href="#resources" role="tab">
                    <i class="fa fa-book fa-2x d-block mb-2"></i>
                    <span>Resources</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link tab-card" id="profile-tab" data-toggle="tab" href="#profile" role="tab">
                    <i class="fa fa-user fa-2x d-block mb-2"></i>
                    <span>Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link tab-card" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab">
                    <i class="fa fa-clock-o fa-2x d-block mb-2"></i>
                    <span>Counselor Schedule</span>
                </a>
            </li>
        </ul>
    </div>


    <div class="tab-content animated fadeInRight" id="dashboardTabsContent">
        <div class="tab-pane fade show active ibox-content mb-4" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">

            <div class="mb-4 mt-3">
                <button type="button" class="btn btn-primary btn-hover" style="border-radius: 12px;" data-toggle="modal" data-target="#appointmentModal">
                    <strong>Book Appointment </strong><i class="fa fa-arrow-right ml-2"></i>
                </button>
            </div>

            <div class="timeline animated fadeInRight">
                @foreach($appointments as $appointment)
                <div class="timeline-item">
                    <div class="timeline-point bg-primary"></div>
                    <div class="timeline-content p-3 mb-3 card {{ $appointment->status }}" style="margin-left: 1rem;">
                        <p><strong>Counselor:</strong> {{ $appointment->counselor->name }}</p>
                        <p><strong>Date:</strong> {{ $appointment->appointment_time->format('M d, Y') }}</p>
                        <p><strong>Time:</strong> {{ $appointment->appointment_time->format('h:i A') }}</p>
                        <p><strong>Reason:</strong> {{ $appointment->reason }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge {{ $appointment->statusBadgeClass() }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </p>

                        @if(in_array($appointment->status, ['pending','approved']))
                        <form method="POST" action="{{ route('student.appointments.destroy', $appointment->id) }}" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-xs btn-danger cancel-appointment-btn">Cancel</button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="timeline-wrapper">
                <div class="mt-3">
                    {{ $appointments->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="resources" role="tabpanel" aria-labelledby="resources-tab">
            <div class="mt-3">
                <h3>Resources</h3>
                <p>List videos, articles, and self-help tools here.</p>
            </div>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @include('student.studentProfile')
        </div>

        <div class="tab-pane fade" id="calendar" role="tabpanel" aria-labelledby="resources-tab">
            <div class="mt-3">
                <h3>calendar</h3>
                <p>calendar.</p>
            </div>
        </div>
    </div>
</section>

<!-- Appointment Modal -->
<div class="modal fade mt-5" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel"> <strong>Book Appointment</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="appointmentForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Counselor</label>
                        <select name="counselor_id" class="form-control" required>
                            @foreach($counselors as $counselor)
                            <option value="{{ $counselor->id }}">{{ $counselor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Select Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Select Time</label>
                        <input type="time" name="time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="bookAppointmentBtn" class="btn btn-primary">Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

{{-- style --}}
@section('style')
<style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    a,
    li {
        font-family: 'Poppins', sans-serif;
    }

    h2 {
        font-weight: 600;
    }

    p {
        font-weight: 400;
    }

    .ibox,
    .ibox-content {
        border-radius: 12px !important;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .ibox:hover {
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .timeline {
        border-left: 3px solid #1ab394;
        margin-left: 20px;
        padding-left: 20px;
    }

    .timeline-content {
        border: 1px solid #e4e7ec;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .timeline-content.pending {
        background-color: #fff8e1 !important;
        /* soft yellow for pending */
        border-color: #ffe082 !important;
    }

    .timeline-content.approved {
        background-color: #e8f5e9;
        /* soft green for approved */
        border-color: #81c784;
    }

    .timeline-content.rejected {
        background-color: #ffebee;
        /* soft red for rejected */
        border-color: #e57373;
    }

    .timeline-content.cancelled {
        background-color: #eceff1;
        /* soft gray for cancelled */
        border-color: #b0bec5;
    }


    .timeline-item {
        position: relative;
    }

    .timeline-point {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        position: absolute;
        left: -35px;
        top: 90px;
    }

    .tab-wrapper {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .nav-tabs {
        border-bottom: none;
    }

    .nav-tabs .nav-item {
        margin: 0 8px;
    }

    .nav-tabs .nav-link.tab-card {
        border: 1px solid #e4e7ec;
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        color: #495057;
        transition: all 0.3s ease;
        margin: 0;
    }

    .nav-tabs .nav-link.tab-card:hover {
        color: #1ab394;
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .nav-tabs .nav-link.tab-card.active {
        background-color: #1ab394;
        color: #fff;
        border-color: #1ab394;
    }

    .nav-tabs .nav-link.tab-card i {
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link.tab-card:hover i {
        color: #1ab394;
    }

    .nav-tabs .nav-link.tab-card.active i {
        color: #fff;
    }

    .btn-hover:hover {
        background-color: transparent;
        color: #1ab394;
        border: 2px solid #1ab394;
    }

</style>
@endsection

{{-- script --}}
@section('scripts')
<script>
    $(document).ready(function() {
        // Set up CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Change the button type to "submit" for the Book button
        $(document).on('click', '#bookAppointmentBtn', function(e) {
            e.preventDefault();
            var form = $('#appointmentForm');
            $.ajax({
                url: '{{ route("student.dashboard.store") }}',
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#appointmentModal').modal('hide');
                    form[0].reset();
                    loadAppointments();
                    Swal.fire({
                        icon: 'success',
                        title: 'Appointment booked!',
                        text: 'Your appointment has been successfully booked.'
                    });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Something went wrong. Please try again.'
                    });
                }
            });
        });

        // Update the cancel button event handler
        $(document).on('click', '.cancel-appointment-btn', function(e) {
            e.preventDefault();
            var $form = $(this).closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "This appointment will be cancelled.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: $form.serialize(),
                        success: function(response) {
                            loadAppointments();
                            Swal.fire(
                                'Cancelled!',
                                'Your appointment has been cancelled.',
                                'success'
                            );
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            Swal.fire(
                                'Error!',
                                'Could not cancel appointment.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        // Function to load appointments
        function loadAppointments() {
            $.ajax({
                url: '{{ route("student.dashboard.appointments") }}',
                type: 'GET',
                success: function(data) {
                    $('.timeline').replaceWith(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Handle pagination clicks
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url, function(data) {
                $('.timeline').replaceWith(data);
            });
        });
    });
</script>
@endsection
