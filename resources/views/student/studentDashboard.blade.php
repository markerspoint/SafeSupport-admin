    @extends('layouts.student-master')

    @section('body')

    <section>
        {{-- tabs --}}
        <div class="mb-4 tab-wrapper p-3">
            <ul class="nav nav-tabs nav-fill" id="dashboardTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link tab-card active" id="appointments-tab" data-toggle="tab" href="#appointments" role="tab">
                        <i class="fa fa-calendar fa-2x mb-2"></i>

                        <div>Appointments</div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link tab-card" id="resources-tab" data-toggle="tab" href="#resources" role="tab">
                        <i class="fa fa-book fa-2x mb-2"></i>
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
                        <div style="font-size: 0.7rem; !important">Counselor Schedule</div>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="dashboardTabsContent">
            <!-- Appointments Tab -->
            <div class="tab-pane active ibox-content mb-4 animated fadeInRight" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">

                <div class="mb-4 mt-3">
                    <button type="button" class="btn btn-primary" style="border-radius: 12px;" data-toggle="modal" data-target="#appointmentModal">
                        <strong>Book Appointment</strong>
                        <i class="fa fa-arrow-right ml-2"></i>
                    </button>
                </div>

                <div class="timeline">
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

                            <button class="btn btn-danger btn-sm delete-btn" style="width: 3rem; height: auto;" data-id="{{ $appointment->id }}" title="Delete Appointment">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    {{ $appointments->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <div class="tab-pane fade" id="resources" role="tabpanel" aria-labelledby="resources-tab">
                <div class="ibox-content mb-4">
                    @include('student.studentResource')
                </div>
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="ibox-content mb-4">
                    @include('student.studentProfile')
                </div>
            </div>

            <div class="tab-pane fade" id="calendar" role="tabpanel" aria-labelledby="calendar-tab">
                <div><h1>calendar</h1></div>
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
    @push('style')
    <style>
        :root {
            --tab-card-w: 10rem;
            --tab-card-h: 6.2rem;
            --tab-card-gap: 1rem;
            --tab-card-radius: 1rem;
            --tab-card-padding: 1rem 1.25rem;
            --tab-card-color: #1ab394;
            --tab-card-bg: #ffffff;
            --tab-card-shadow: 0 0.125rem 0.375rem rgba(0, 0, 0, 0.08);
        }

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
            transition: box-shadow .3s ease, transform .3s ease;
        }

        .ibox:hover {
            box-shadow: 0 .375rem .625rem rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        /* Timeline  */
        .timeline {
            border-left: .1875rem solid var(--tab-card-color);
            margin-left: 1.25rem;
            padding-left: 1.25rem;
        }

        .timeline-content {
            border: 1px solid #e4e7ec;
            background: #fff;
            border-radius: .75rem;
            padding: 1rem;
        }

        .timeline-item {
            position: relative;
        }

        .timeline-point {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            position: absolute;
            left: -2.3rem;
            top: 3rem;
        }

        /* Tab wrapper */
        .tab-wrapper {
            background: var(--tab-card-bg);
            border-radius: .75rem;
            box-shadow: 0 .25rem .625rem rgba(0, 0, 0, 0.05);
            padding: 1rem;
        }

        .timeline-content.pending {
            background-color: #fff8e1 !important;
            border-color: #ffe082 !important;
        }

        .timeline-content.approved {
            background-color: #e8f5e9;
            border-color: #81c784;
        }

        .timeline-content.rejected {
            background-color: #ffebee;
            border-color: #e57373;
        }

        .timeline-content.cancelled {
            background-color: #eceff1;
            border-color: #b0bec5;
        }

        /* Nav-tabs container  */
        .nav-tabs {
            display: flex !important;
            flex-wrap: wrap;
            gap: var(--tab-card-gap);
            align-items: stretch;
            justify-content: flex-start;
            border-bottom: none;
            padding: 0;
            margin: 0;
        }

        .nav-tabs.nav-fill .nav-item,
        .nav-tabs .nav-item {
            flex: 0 0 auto;
        }

        /* -------------------------
    Tab card (fixed size)
    ------------------------- */
        .nav-tabs .nav-link.tab-card {
            box-sizing: border-box;
            background: var(--tab-card-bg);
            border-radius: var(--tab-card-radius);
            box-shadow: var(--tab-card-shadow);
            padding: var(--tab-card-padding);
            font-weight: 700;
            color: var(--tab-card-color);
            text-align: center;

            width: var(--tab-card-w) !important;
            height: var(--tab-card-h) !important;

            transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
        }

        /* Icon (top) */
        .nav-tabs .nav-link.tab-card i {
            font-size: 2rem;
            color: var(--tab-card-color);
            line-height: 1;
            display: block;
            margin-top: .2rem;
            flex-shrink: 0;
        }

        .tab-card {
            border: #1ab394 !important;
        }

        /* hover */
        .nav-tabs .nav-link.tab-card:hover {
            background: #f8f9fa;
            /* transform: translateY(-.125rem); */
            box-shadow: 0 .25rem .625rem rgba(0, 0, 0, 0.12);
        }

        /* active tab */
        .nav-tabs .nav-link.tab-card.active {
            background: var(--tab-card-color);
            color: #fff;
            box-shadow: 0 .25rem .75rem rgba(26, 179, 148, 0.28);
        }

        .nav-tabs .nav-link.tab-card.active i {
            color: #fff;
        }

        /* -------------------------
    Tab: 2x2 grid at <=480px
    ------------------------- */
        @media (max-width: 768px) {
            :root {
                --tab-card-w: auto;
                --tab-card-h: 8rem;
            }

            .nav-tabs {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                justify-content: stretch !important;
            }
        }

    </style>
    @endpush

    {{-- scripts --}}
    @push('scripts')
    <script>
        $('#bookAppointmentBtn').on('click', function() {
            var $btn = $(this);
            var $form = $('#appointmentForm');

            $btn.prop('disabled', true).text('Booking…');

            $.ajax({
                url: '{{ route("student.dashboard.store") }}'
                , type: 'POST'
                , data: $form.serialize()
                , dataType: 'json'
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    $('#appointmentModal').modal('hide');
                    $form[0].reset();
                    $btn.prop('disabled', false).text('Book');

                    $.ajax({
                        url: '{{ route("student.dashboard") }}?page=1'
                        , type: 'GET'
                        , success: function(resp) {
                            let html = $(resp).find('.timeline').html();
                            let pagination = $(resp).find('.pagination').html();
                            $('.timeline').html(html);
                            $('.pagination').html(pagination);
                        }
                    });

                    Swal.fire({
                        title: 'Appointment Booked!'
                        , text: 'Your appointment has been successfully created.'
                        , icon: 'success'
                        , confirmButtonText: 'OK'
                    });
                }
                , error: function(xhr) {
                    $btn.prop('disabled', false).text('Book');

                    let message = 'Something went wrong. Please try again.';

                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        message = '';
                        $.each(xhr.responseJSON.errors, function(k, v) {
                            message += (v[0] || '') + '\n';
                        });
                    }

                    Swal.fire({
                        title: 'Error'
                        , text: message
                        , icon: 'error'
                        , confirmButtonText: 'Close'
                    });

                    console.error('Booking error:', xhr.status, xhr.responseText);
                }
            });
        });

        // escape HTML to avoid XSS
        function escapeHtml(unsafe) {
            return String(unsafe || '').replace(/[&<>"'`=\/]/g, function(s) {
                return ({
                    '&': '&amp;'
                    , '<': '&lt;'
                    , '>': '&gt;'
                    , '"': '&quot;'
                    , "'": '&#39;'
                    , '/': '&#x2F;'
                    , '`': '&#x60;'
                    , '=': '&#x3D;'
                })[s];
            });
        }

        // AJAX pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');

            $.ajax({
                url: url
                , type: 'GET'
                , success: function(response) {
                    var html = $(response).find('.timeline').html();
                    $('.timeline').html(html);

                    var pagination = $(response).find('.pagination').html();
                    $('.pagination').html(pagination);
                }
                , error: function(xhr) {
                    Swal.fire({
                        title: 'Error'
                        , text: 'Could not load page.'
                        , icon: 'error'
                        , confirmButtonText: 'Close'
                    });
                    console.log(xhr.responseText);
                }
            });
        });

        // prevent booking of past days
        $(document).ready(function() {
            var today = new Date().toISOString().split('T')[0];
            $('input[name="date"]').attr('min', today);
        });

        //delete button
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            var $btn = $(this);

            Swal.fire({
                title: 'Are you sure?'
                , text: "This appointment will be permanently deleted!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonText: 'Yes, delete it!'
                , cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting…');

                    $.ajax({
                        url: '{{ route("student.dashboard.destroy", "") }}/' + id
                        , type: 'DELETE'
                        , headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , success: function(response) {
                            $btn.closest('.timeline-item').remove();

                            Swal.fire(
                                'Deleted!'
                                , response.message
                                , 'success'
                            );
                        }
                        , error: function(xhr) {
                            $btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');

                            Swal.fire(
                                'Error'
                                , 'Could not delete appointment.'
                                , 'error'
                            );

                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });

    </script>
    @endpush
