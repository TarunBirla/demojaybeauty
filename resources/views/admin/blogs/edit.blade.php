@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')
@section('page_title', 'Edit Blog Post')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="fa-solid fa-pen-to-square text-warning me-2"></i> Edit Blog: {{ $blog->title }}</span>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Blogs
                </a>
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Blog Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Featured Image</label>
                            @if($blog->image)
                                <div class="mb-2">
                                    <span class="text-muted small d-block mb-1">Current Image:</span>
                                    <img src="{{ asset($blog->image) }}" alt="Current" class="img-thumbnail rounded" style="max-height: 120px;">
                                </div>
                            @endif
                            <input type="file" name="image" id="blogImageInput" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewBlogImage(this)">
                            <small class="text-muted">Upload a new image to replace the current one.</small>
                            <div class="mt-2" id="imagePreviewContainer" style="display: none;">
                                <span class="text-success small d-block mb-1">New Image Preview:</span>
                                <img id="imagePreview" src="" alt="Preview" class="img-thumbnail rounded" style="max-height: 150px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Publication Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status', $blog->status) === 'active' ? 'selected' : '' }}>Active (Visible on Website)</option>
                                <option value="inactive" {{ old('status', $blog->status) === 'inactive' ? 'selected' : '' }}>Inactive (Hidden from Public)</option>
                            </select>
                            <small class="text-muted">Inactive blogs will not be shown on the public frontend.</small>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Blog Content / Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="blogEditor" class="form-control" rows="10">{{ old('description', $blog->description) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                        <button type="submit" class="btn btn-gold px-4">
                            <i class="fa-solid fa-save me-1"></i> Update Blog
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#blogEditor').summernote({
            tabsize: 2,
            height: 350,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'italic', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });

    function previewBlogImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreviewContainer').show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
