@extends('layout.editor')
@section('title')
    Edit Statistic
@endsection

@section('content')
<div id="content">
    <!-- Topbar -->
    @include('include.editor.topbar')
    <!-- End of Topbar -->
    
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Statistic</h1>
            <a href="{{ route('statistic.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistic Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('statistic.update', $statistic->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="label">Label (English) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('label') is-invalid @enderror" 
                                       id="label" name="label" value="{{ old('label', $statistic->label) }}" 
                                       placeholder="e.g., Designs Completed" required>
                                @error('label')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="label_id">Label (Bahasa Indonesia) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('label_id') is-invalid @enderror" 
                                       id="label_id" name="label_id" value="{{ old('label_id', $statistic->label_id) }}" 
                                       placeholder="e.g., Desain Selesai" required>
                                @error('label_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="value">Value <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('value') is-invalid @enderror" 
                               id="value" name="value" value="{{ old('value', $statistic->value) }}" 
                               placeholder="e.g., 10" required>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon Image (PNG/JPG/SVG)</label>
                        @if($statistic->icon)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $statistic->icon) }}" alt="Current icon" style="width: 80px; height: 80px; object-fit: contain; border: 1px solid #ddd; padding: 5px;">
                                <p class="text-muted small">Current icon</p>
                            </div>
                        @endif
                        <input type="file" class="form-control-file @error('icon') is-invalid @enderror" 
                               id="icon" name="icon" accept="image/*">
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Recommended size: 80x80px. Leave empty to keep current icon.</small>
                    </div>

                    <div class="form-group">
                        <label for="order">Display Order</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" 
                               id="order" name="order" value="{{ old('order', $statistic->order) }}" 
                               placeholder="0">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Lower numbers appear first. Default is 0.</small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Statistic
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
