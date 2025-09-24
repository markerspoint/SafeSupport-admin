@extends('layouts.student-master')

@section('body')

<section>
    {{-- tabs --}}
    <div class="mb-4 tab-wrapper p-3">
        <ul class="nav nav-tabs nav-fill" id="dashboardTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link tab-card active" id="appointments-tab" data-toggle="tab" href="#appointments" role="tab">
                    <i class="fa fa-calendar fa-2x mb-2"></i></i>

                    <div>Appointments</div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link tab-card" id="resources-tab" data-toggle="tab" href="#resources" role="tab">
                    <i class="fa fa-book fa-2x mb-2"></i></i>
                    <div>Resources</div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link tab-card" id="profile-tab" data-toggle="tab" href="#profile" role="tab">
                    <i class="fa fa-user fa-2x mb-2"></i>
                    <div>Profile</div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link tab-card" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab">
                    <i class="fa fa-clock-o fa-2x mb-2"></i>
                    <div>Counselor Schedule</div>
                </a>
            </li>
        </ul>
    </div>


    <div class="tab-content" id="dashboardTabsContent">
        <!-- Appointments Tab -->
        <div class="tab-pane fade show active ibox-content mb-4" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">

            <div class="mb-4 mt-3">
                <button type="button" class="btn btn-primary" style="border-radius: 12px;" data-toggle="modal" data-target="#appointmentModal">
                    Book Appointment
                </button>
            </div>

            <div class="timeline">
                @foreach($appointments as $appointment)
                <div class="timeline-item">
                    <div class="timeline-point bg-primary"></div>
                    <div class="timeline-content p-3 mb-3 card" style="margin-left: 1rem;">
                        <p><strong>Counselor:</strong> {{ $appointment->counselor->name }}</p>
                        <p><strong>Date:</strong> {{ $appointment->appointment_time->format('M d, Y') }}</p>
                        <p><strong>Time:</strong> {{ $appointment->appointment_time->format('h:i A') }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge 
                                    @if($appointment->status == 'pending') badge-warning
                                    @elseif($appointment->status == 'rejected') badge-danger
                                    @else badge-primary @endif">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-3">
                {{ $appointments->links('pagination::bootstrap-4') }}
            </div>
        </div>


        <!-- Resources Tab -->
        <div class="tab-pane fade" id="resources" role="tabpanel" aria-labelledby="resources-tab">
            <div class="mt-3">
                <h3>Resources</h3>
                <p>List videos, articles, and self-help tools here.</p>
            </div>
        </div>

        <!-- Profile Tab -->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="mt-3">
                <h3>Profile Section</h3>
                <p>Here you can show student profile info or settings.</p>
            </div>
        </div>

        <!-- Profile Tab -->
        <div class="tab-pane fade" id="calendar" role="tabpanel" aria-labelledby="calendar-tab">
            <div class="mt-3">
                <h3>calendar Section</h3>
                <p>Here you can show student profile info or settings.</p>
            </div>
        </div>

</section>

<!-- Appointment Modal -->
<div class="modal fade mt-5" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel">Book Appointment</h5>
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
                    <button type="button" id="bookAppointmentBtn" class="btn btn-primary">Book</button>
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
        margin: 0;
        padding: 0;
    }

    h2 {
        font-weight: 600;
    }

    p {
        font-weight: 400;
    }

    #dashHead,
    .ibox,
    .ibox-content {
        overflow: hidden;
        border-radius: 1rem;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .ibox:hover {
        box-shadow: 0 0.375rem 0.625rem rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    /* Timeline */
    .timeline {
        border-left: 0.1875rem solid #1ab394;
        margin-left: 1.25rem;
        padding-left: 1.25rem;
    }

    .timeline-content {
        border: 1px solid #e4e7ec;
        background-color: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 0.25rem 0.625rem rgba(0, 0, 0, 0.05);
        padding: 1rem;
    }

    .timeline-item {
        position: relative;
    }

    .timeline-point {
        width: 0.75rem;
        height: 0.75rem;
        border-radius: 50%;
        position: absolute;
        left: -0.5625rem;
        top: 0.625rem;
    }

    /* Tab wrapper */
    .tab-wrapper {
        background-color: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 0.25rem 0.625rem rgba(0, 0, 0, 0.05);
        padding: 1rem;
    }

    /* Nav tabs */
    .nav-tabs {
        border-bottom: none;
        border-radius: 0.75rem;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 1rem;
    }

    .nav-tabs .nav-link {
        border: none;
        font-weight: 500;
        color: #495057;
    }

    /* Card-style tabs (vertical layout) */
    .nav-tabs .nav-link.tab-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0.125rem 0.375rem rgba(0, 0, 0, 0.08);
        margin: 0.25rem;
        padding: 1.25rem 1.5rem;
        font-weight: 500;
        color: #495057;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        min-width: 8rem;
    }

    /* Tab icon */
    .nav-tabs .nav-link.tab-card i {
        font-size: 2rem;
        color: #1ab394;
        margin-bottom: 0.625rem;
    }

    /* Hover effect */
    .nav-tabs .nav-link.tab-card:hover {
        background: #f8f9fa;
        box-shadow: 0 0.25rem 0.625rem rgba(0, 0, 0, 0.12);
    }

    /* Active tab */
    .nav-tabs .nav-link.tab-card.active {
        background: #1ab394;
        color: #fff;
        font-weight: 600;
        box-shadow: 0 0.25rem 0.75rem rgba(26, 179, 148, 0.3);
    }

    .nav-tabs .nav-link.tab-card.active i {
        color: #fff;
    }
</style>
@endsection



{{-- script --}}
@section('scripts')
<script>
    $(document).ready(function() {

        // Appointment booking AJAX (already working)
        $('#bookAppointmentBtn').click(function() {
            var form = $('#appointmentForm');
            $.ajax({
                url: '{{ route("student.dashboard.store") }}'
                , type: 'POST'
                , data: form.serialize()
                , success: function(response) {
                    $('#appointmentModal').modal('hide');
                    form[0].reset();
                    var newTimelineItem = `
                    <div class="timeline-item">
                        <div class="timeline-point bg-primary"></div>
                        <div class="timeline-content p-3 mb-3 card" style="margin-left: 1rem;">
                            <p><strong>Counselor:</strong> ${response.counselor_name}</p>
                            <p><strong>Date:</strong> ${response.date}</p>
                            <p><strong>Time:</strong> ${response.time}</p>
                            <p><strong>Status:</strong>
                                <span class="badge badge-warning">${response.status}</span>
                            </p>
                        </div>
                    </div>
                `;
                    $('.timeline').prepend(newTimelineItem);
                    toastr.success('Appointment booked successfully!');
                }
                , error: function(xhr) {
                    console.log(xhr.responseText);
                    toastr.error('Something went wrong.');
                }
            });
        });

        // AJAX pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault(); // prevent full page reload
            var url = $(this).attr('href');

            $.ajax({
                url: url
                , type: 'GET'
                , success: function(response) {
                    // Replace the timeline container with new content
                    var html = $(response).find('.timeline').html();
                    $('.timeline').html(html);

                    // Replace pagination links
                    var pagination = $(response).find('.pagination').html();
                    $('.pagination').html(pagination);
                }
                , error: function(xhr) {
                    console.log(xhr.responseText);
                    toastr.error('Could not load page.');
                }
            });
        });

    });

</script>
@endsection
