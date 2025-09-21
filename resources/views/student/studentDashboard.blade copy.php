    @extends('layouts.student-master')

    @section('body')

    <section>
        <div class="m-b-md">
            <div class="border-bottom white-bg page-heading" id="dashHead">
                <div class="col-lg-12">
                    <h2>Dashboard</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('student.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Dashboard</strong>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- tabs --}}
        <div class="mb-4 tab-wrapper p-3">
            <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="appointments-tab" data-toggle="tab" href="#appointments" role="tab" aria-controls="appointments" aria-selected="true">
                        Appointments
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="resources-tab" data-toggle="tab" href="#resources" role="tab" aria-controls="resources" aria-selected="false">
                        Resources
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        Profile
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#calendar" role="tab" aria-controls="profile" aria-selected="false">
                        Counselor Schedule
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
                        <div class="timeline-content p-3 mb-3 card" style="margin-left: 2rem;">
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
                <form action="{{ route('student.dashboard.store') }}" method="POST">
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
                        <button type="submit" class="btn btn-primary">Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @endsection

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

        #dashHead {
            overflow: hidden;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            border-radius: 12px !important;
        }

        .ibox {
            overflow: hidden;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            border-radius: 12px !important;
        }

        .ibox-content {
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            border-radius: 12px !important;
        }

        .ibox:hover {
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        /* Timeline */
        .timeline {
            border-left: 3px solid #1ab394;
            margin-left: 20px;
            padding-left: 20px;
        }

        .timeline-content {
            border: 1px solid #e4e7ec;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05) !important;
        }

        .timeline-item {
            position: relative;
        }

        .timeline-point {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            position: absolute;
            left: -9px;
            top: 10px;
        }

        /* tabs */
        .tab-wrapper {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .nav-tabs {
            border-bottom: none;
            border-radius: 12px;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: #eeeeee;
            border-radius: 12px 12px 0 0;
        }

        .nav-tabs .nav-link {
            border: none;
            margin-right: 5px;
            font-weight: 500;
            color: #495057;
        }

    </style>
    @endsection
