@php
use App\Models\Resource;
$resources = Resource::latest()->get();
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h4 class="mb-4">Available Resources</h4>
        </div>
    </div>

    <div class="row">
        @forelse($resources as $resource)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $resource->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted text-capitalize">{{ $resource->type }}</h6>
                    <p class="card-text">{{ $resource->description ?? 'No description provided.' }}</p>

                    @if($resource->file_path)
                    <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank" class="btn btn-primary btn-sm mt-auto">
                        <i class="fa fa-download"></i> Download
                    </a>
                    @elseif($resource->url)
                    <a href="{{ $resource->url }}" target="_blank" class="btn btn-primary btn-sm mt-auto">
                        <i class="fa fa-link"></i> Open Link
                    </a>
                    @endif

                    <p class="mt-2 text-muted small">
                        Uploaded by: {{ $resource->creator->name ?? 'Unknown' }} <br>
                        {{ $resource->created_at->format('F d, Y') }}
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                No resources available at the moment.
            </div>
        </div>
        @endforelse
    </div>
</div>





@push('style')
<style>
    .card {
        border-radius: 12px;
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

</style>
@endpush
