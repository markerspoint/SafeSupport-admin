@extends('layouts.counselor-master')

@section('body')
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

<section class="animated fadeInRight">
    <div class="border-bottom white-bg page-heading" id="resourcesHead">
        <div class="col-lg-12">
            <h2 class="heading-hover"><i class="fa fa-book"></i> Resources</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('counselor.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Resources</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center">
                    <h3 class="font-bold">Resource Manager</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addResourceModal">
                        <i class="fa fa-plus"></i> Add New Resource
                    </button>
                </div>

                <!-- Add Resource Modal -->
                <div class="modal fade" id="addResourceModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Add New Resource</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>

                            <form action="{{ route('counselor.resources.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Type</label>
                                        <select name="type" class="form-control" id="resourceType" required>
                                            <option value="video">Video</option>
                                            <option value="tool">Self-help Tool</option>
                                            <option value="article">Article</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="resourceUrlGroup">
                                        <label>URL (for Video/Article)</label>
                                        <input type="url" name="url" class="form-control" placeholder="https://example.com">
                                    </div>

                                    <div class="form-group" id="resourceFileGroup" style="display:none;">
                                        <label>Upload Tool (PDF, DOCX)</label>
                                        <input type="file" name="file_path" class="form-control">
                                        <small class="form-text text-muted">Or provide a URL to an external form like Google Form.</small>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Save Resource</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


                {{-- main content --}}
                <div class="ibox-content">
                    <!-- Filter Buttons -->
                    <div class="mb-3">
                        <div class="btn-group" role="group" aria-label="Resource Type Filter">
                            <button type="button" class="btn active" data-filter="all">All</button>
                            <button type="button" class="btn" data-filter="video">Videos</button>
                            <button type="button" class="btn" data-filter="article">Articles</button>
                            <button type="button" class="btn" data-filter="tool">Tools</button>
                        </div>
                    </div>

                    <!-- Resource Cards -->
                    <div class="row">
                        @forelse($resources as $resource)
                        <div class="col-lg-4 col-md-6 mb-4 resource-card" data-type="{{ $resource->type }}">
                            <div class="card shadow-sm h-100">
                                {{-- Thumbnail --}}
                                @if($resource->type === 'video' && $resource->url)
                                <img src="{{ youtubeThumbnail($resource->url) }}" class="card-img-top" alt="{{ $resource->title }}" style="height: 180px; object-fit: cover; border-radius: 12px 12px 0 0;">
                                @elseif($resource->type === 'article')
                                <div class="card-img-top d-flex align-items-center justify-content-center text-white font-weight-bold" style="height: 180px; background: #6c757d; border-radius: 12px 12px 0 0;">
                                    Article
                                </div>
                                @else
                                <img src="{{ asset('template/img/default_resource.png') }}" class="card-img-top" alt="{{ $resource->title }}" style="height: 180px; object-fit: cover; border-radius: 12px 12px 0 0;">
                                @endif

                                {{-- Card Body --}}
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $resource->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted text-capitalize">{{ $resource->type }}</h6>
                                    <p class="card-text text-truncate-2">{{ $resource->description ?? 'No description provided.' }}</p>

                                    @if($resource->description)
                                    <button type="button" class="btn btn-link p-0 mt-1 mb-2 text-primary" data-toggle="modal" data-target="#resourceModal{{ $resource->id }}">
                                        Read more
                                    </button>
                                    @endif

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
            </div>
        </div>
    </div>
</section>
@endsection

@push('style')
<style>
    #resourcesHead {
        border-radius: 12px !important;
    }

    .heading-hover {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.3s ease, transform 0.3s ease;
        cursor: pointer;
        font-weight: 700;
    }

    .heading-hover i {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .heading-hover:hover {
        color: #1ab394;
        transform: translateY(-2px);
    }

    .heading-hover:hover i {
        transform: rotate(20deg);
        color: #1ab394;
    }

    .card {
        border-radius: 12px;
        transition: box-shadow 0.3s ease;
    }

    .card-title {
        color: #1ab394;
        font-size: 0.9rem;
    }

    .card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .btn-group .btn {
        color: #1ab394;
        border: 1px solid #1ab394;
        background-color: transparent;
        transition: all 0.3s;
    }

    .btn-group .btn.active,
    .btn-group .btn:hover {
        background-color: #1ab394;
        color: #fff;
        border-color: #1ab394;
    }

    .ibox {
        overflow: hidden;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        border-radius: 12px !important;
    }

</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('.btn-group button').click(function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            var filter = $(this).data('filter');

            $('.resource-card').each(function() {
                if (filter === 'all') $(this).show();
                else $(this).toggle($(this).data('type') === filter);
            });
        });
    });

</script>
@endpush
