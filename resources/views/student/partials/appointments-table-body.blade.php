@forelse($appointments as $index => $appointment)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>{{ $appointment->counselor->name ?? 'N/A' }}</td>
    <td>{{ $appointment->appointment_time->format('M d, Y H:i') }}</td>
    <td>
        @if($appointment->status === 'pending')
            <span class="badge badge-warning">Pending</span>
        @elseif($appointment->status === 'accepted')
            <span class="badge badge-primary">Accepted</span>
        @else
            <span class="badge badge-danger">Rejected</span>
        @endif
    </td>
    <td>{{ $appointment->reason }}</td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center">No appointments booked yet.</td>
</tr>
@endforelse
