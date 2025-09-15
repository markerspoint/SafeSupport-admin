@extends('layouts.counselor-master')

<style>
    #resourcesHead {
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

    .resource-thumb {
        height: 10rem;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .resource-thumb img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        display: block;
    }

    .thumb-placeholder {
        font-weight: bold;
        color: #555;
    }

    .resource-info {
        flex: 1;
        padding: 0.5rem 1rem;
        display: flex;
        flex-direction: column;
    }

    .resource-title {
        font-size: 1rem;
        font-weight: bold;
        margin: 0.25rem 0;
    }

    .resource-desc {
        font-size: 0.85rem;
        color: #666;
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .resource-actions {
        padding: 0.5rem 1rem;
        text-align: right;
    }

    .resource-card {
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
        border: 1px solid transparent;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        border-radius: 8px;
    }

    .resource-card:hover {
        transform: scale(1.02);
        border-color: #1ab394;
    }

</style>

@section('body')
<section>
    <div class="m-b-md">
        <div class="border-bottom white-bg page-heading" id="resourcesHead">
            <div class="col-lg-12">
                <h2>Resources</h2>
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
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center">
                    <h3 class="font-bold">Resource Manager</h3>
                    <button type="button" class="btn btn-primary" style="margin-right: -4rem;" data-toggle="modal" data-target="#addResourceModal">
                        <i class="fa fa-plus"></i> Add New Resource
                    </button>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        @foreach($resources as $resource)
                        <div class="col-lg-4 px-4">
                            <div class="resource-card ibox">
                                <div class="resource-thumb">
                                    @if($resource->type == 'video')
                                    @php
                                    preg_match("/v=([a-zA-Z0-9_-]+)/", $resource->url, $matches);
                                    $videoId = $matches[1] ?? null;
                                    @endphp
                                    @if($videoId)
                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" alt="{{ $resource->title }}">
                                    @else
                                    <div class="thumb-placeholder">Video</div>
                                    @endif
                                    @elseif($resource->type == 'tool')
                                    <div class="thumb-placeholder">Tool</div>
                                    @else
                                    <div class="thumb-placeholder">Article</div>
                                    @endif
                                </div>

                                <!-- Title / Description -->
                                <div class="resource-info">
                                    <small class="text-muted">{{ ucfirst($resource->type) }}</small>
                                    <h5 class="resource-title">{{ $resource->title }}</h5>
                                    <p class="resource-desc">{{ $resource->description }}</p>
                                </div>

                                <!-- Button -->
                                <div class="resource-actions">
                                    @if($resource->type == 'video')
                                    <a href="{{ $resource->url }}" target="_blank" class="btn btn-xs btn-outline btn-primary">
                                        Watch <i class="fa fa-long-arrow-right"></i>
                                    </a>
                                    @elseif($resource->type == 'tool')
                                    <a href="{{ asset($resource->url) }}" target="_blank" class="btn btn-xs btn-outline btn-primary">
                                        Open Tool <i class="fa fa-long-arrow-right"></i>
                                    </a>
                                    @elseif($resource->type == 'article')
                                    <a href="{{ $resource->url }}" target="_blank" class="btn btn-xs btn-outline btn-primary">
                                        Read Article <i class="fa fa-long-arrow-right"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- Add Resource Modal -->
<div class="modal fade" id="addResourceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                        <textarea name="description" class="form-control" rows="3" required></textarea>
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
                        <input type="file" name="file" class="form-control">
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
@endsection

@section('scripts')
<script>
    // Toggle URL/file inputs based on type
    $('#resourceType').change(function() {
        var type = $(this).val();
        if (type === 'tool') {
            $('#resourceFileGroup').show();
            $('#resourceUrlGroup').hide();
        } else {
            $('#resourceFileGroup').hide();
            $('#resourceUrlGroup').show();
        }
    });

</script>
@endsection
