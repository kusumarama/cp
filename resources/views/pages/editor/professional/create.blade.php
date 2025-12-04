@extends('layout.editor')
@section('title')
    Add Professional
@endsection

@section('content')
<div id="content">
    <!-- Topbar -->
    @include('include.editor.topbar')
    <!-- End of Topbar -->
    
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add New Professional</h1>
            <a href="{{ route('editor.professional') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Professional Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('editor.professional.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Category <span class="text-danger">*</span></label>
                        <select class="form-control @error('category') is-invalid @enderror" 
                                id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="board_of_director" {{ old('category') == 'board_of_director' ? 'selected' : '' }}>Board of Director</option>
                            <option value="management" {{ old('category') == 'management' ? 'selected' : '' }}>Management</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="position">Position <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" 
                               id="position" name="position" value="{{ old('position') }}" 
                               placeholder="e.g., President Commissioner" required list="position-suggestions">
                        <datalist id="position-suggestions">
                            <option value="President Commissioner">
                            <option value="Commissioner">
                            <option value="President Director">
                            <option value="Director">
                            <option value="General Manager">
                            <option value="Manager">
                            <option value="Supervisor">
                            <option value="Staff">
                        </datalist>
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Enter position title. You can select from suggestions or type a custom one.</small>
                    </div>

                    <div class="form-group">
                        <label for="details">Details/Biography</label>
                        <textarea class="form-control @error('details') is-invalid @enderror" 
                                  id="details" name="details" rows="5">{{ old('details') }}</textarea>
                        @error('details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="photo">Photo <span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file @error('photo') is-invalid @enderror" 
                               id="photo" name="photo" accept="image/*" required>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Recommended: Square image (800x800px or similar ratio)</small>
                    </div>

                    <div class="form-group">
                        <label for="order">Display Order</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" 
                               id="order" name="order" value="{{ old('order', 0) }}">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Lower numbers appear first</small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Professional
                        </button>
                        <a href="{{ route('editor.professional') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
