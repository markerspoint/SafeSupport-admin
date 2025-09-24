@php
use App\Models\Resource;
$resources = Resource::latest()->get();
@endphp

@php
if (!function_exists('youtubeThumbnail')) {
function youtubeThumbnail($url) {
preg_match("/v=([a-zA-Z0-9_-]+)/", $url, $matches);
return isset($matches[1]) ? "https://img.youtube.com/vi/{$matches[1]}/hqdefault.jpg" : asset('template/img/default_resource.png');
}
}
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
                {{-- Thumbnail --}}
                <img src="{{ $resource->type === 'video' && $resource->url ? youtubeThumbnail($resource->url) : asset('template/img/default_resource.png') }}" class="card-img-top" alt="{{ $resource->title }}" style="height: 180px; object-fit: cover; border-radius: 12px 12px 0 0;">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $resource->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted text-capitalize">{{ $resource->type }}</h6>

                    <p class="card-text text-truncate-2">{{ $resource->description ?? 'No description provided.' }}</p>

                    @if($resource->description)
                    <button type="button" class="btn btn-link p-0 mt-1 mb-2 text-primary" data-toggle="modal" data-target="#resourceModal{{ $resource->id }}">
                        Read more
                    </button>
                    @endif

                    {{-- Open link button --}}
                    @if($resource->url)
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

        {{-- Modal for full description --}}
        @if($resource->description)
        <div class="modal fade" id="resourceModal{{ $resource->id }}" tabindex="-1" aria-labelledby="resourceModalLabel{{ $resource->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resourceModalLabel{{ $resource->id }}">{{ $resource->title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! nl2br(e($resource->description)) !!}
                    </div>
                </div>
            </div>
        </div>
        @endif
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

    /* Limit description to 2 lines with ellipsis */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

</style>
@endpush
