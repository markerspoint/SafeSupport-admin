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

</style>

@section('body')
<section>

    <div class="m-b-md">
        <div class="border-bottom white-bg page-heading" id="profileHead">
            <div class="col-lg-12">
                <h2>Profile</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Profile</strong>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row animated fadeInRight">
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Profile Detail</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right text-center">
                        <img alt="Profile Image" class="img-fluid rounded-circle shadow-sm" style="width: 200px; height: 200px; object-fit: cover;" src="{{ asset('template/img/profile_default.jpg') }}">
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong>{{ Auth::user()->name }}</strong></h4>

                        <p><i class="fa fa-envelope"></i> {{ Auth::user()->email }}</p>

                        <p><i class="fa fa-calendar"></i> Joined: {{ Auth::user()->created_at->format('F d, Y') }}
                        </p>

                        <h5>About me</h5>
                        <p>
                            This is your profile. You can add more details later.
                        </p>

                        <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm btn-block">
                                        <i class="fa fa-envelope"></i> Send Message
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-default btn-sm btn-block">
                                        <i class="fa fa-coffee"></i> Buy a coffee
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Edit Profile</h5>
                </div>
                <div class="ibox-content">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name) }}" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $student->email) }}" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="password">New Password (leave blank to keep current)</label>
                            <input type="password" name="password" placeholder="*****" id="password" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" name="password_confirmation" placeholder="*****" id="password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
