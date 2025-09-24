<div id="studentProfile" class="row animated fadeInRight mt-4">

    {{-- Profile Detail --}}
    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-white">
                <h5 class="mb-0">Profile Detail</h5>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('template/img/profile_default.jpg') }}" alt="Profile Image" class="rounded-circle shadow-sm mb-3" style="width: 180px; height: 180px; object-fit: cover;">

                <h4 class="font-weight-bold">{{ auth()->user()->name }}</h4>
                <p class="mb-1"><i class="fa fa-envelope"></i> {{ auth()->user()->email }}</p>
                <p class="mb-3"><i class="fa fa-calendar"></i> Joined: {{ auth()->user()->created_at->format('F d, Y') }}</p>

                <h6>About Me</h6>
                <p class="text-muted">This is your profile. You can add more details later.</p>
            </div>
        </div>
    </div>

    {{-- Edit Profile --}}
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Edit Profile</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form id="profileForm" action="{{ route('student.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                        <input type="password" name="password" id="password" placeholder="*****" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="*****" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

</div>

@push('style')
<style>
    /* Remove inner border-radius and add shadows to cards */
    #studentProfile .card {
        border-radius: 12px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    #studentProfile .card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        #studentProfile .d-flex.gap-2 {
            flex-direction: column;
        }
    }
</style>
@endpush


{{-- profile script --}}
@push('scripts')
<script>
$(document).ready(function() {
    $('#profileForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);

        $.ajax({
            url: $form.attr('action'),
            type: 'PUT',
            data: $form.serialize(),
            success: function(response) {
                Swal.fire('Success', 'Profile updated!', 'success');
            },
            error: function(xhr) {
                Swal.fire('Error', 'Could not update profile.', 'error');
            }
        });
    });
});
</script>
@endpush
