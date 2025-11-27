@extends('layout.editor')
@section('title')
    Create Statistic
@endsection

@section('content')
<div id="content">
    <!-- Topbar -->
    @include('include.editor.topbar')
    <!-- End of Topbar -->
    
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New Statistic</h1>
            <a href="{{ route('statistic.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistic Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('statistic.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="label">Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" 
                               id="label" name="label" value="{{ old('label') }}" 
                               placeholder="e.g., Designs Completed" required>
                        @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="value">Value <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('value') is-invalid @enderror" 
                               id="value" name="value" value="{{ old('value') }}" 
                               placeholder="e.g., 10" required>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon Image (PNG/JPG/SVG)</label>
                        <input type="file" class="form-control-file @error('icon') is-invalid @enderror" 
                               id="icon" name="icon" accept="image/*">
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Recommended size: 80x80px. Leave empty to use default.</small>
                    </div>

                    <div class="form-group">
                        <label for="order">Display Order</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" 
                               id="order" name="order" value="{{ old('order', 0) }}" 
                               placeholder="0">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Lower numbers appear first. Default is 0.</small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Statistic
                        </button>
                        <a href="{{ route('statistic.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
