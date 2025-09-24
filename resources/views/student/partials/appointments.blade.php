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
