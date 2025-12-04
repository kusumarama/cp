@extends('layout.editor')
@section('title')
    Our Professionals
@endsection

@section('content')
<div id="content">
    <!-- Topbar -->
    @include('include.editor.topbar')
    <!-- End of Topbar -->
    
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Our Professionals</h1>
            <a href="{{ route('editor.professional.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add Professional
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Board of Directors -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Board of Directors</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($professionals->where('category', 'board_of_director') as $prof)
                            <tr>
                                <td>{{ $prof->order }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $prof->photo) }}" alt="{{ $prof->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                </td>
                                <td>{{ $prof->name }}</td>
                                <td>{{ $prof->position }}</td>
                                <td>
                                    <a href="{{ route('editor.professional.edit', $prof->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('editor.professional.destroy', $prof->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No board members found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Management -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Management</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($professionals->where('category', 'management') as $prof)
                            <tr>
                                <td>{{ $prof->order }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $prof->photo) }}" alt="{{ $prof->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                </td>
                                <td>{{ $prof->name }}</td>
                                <td>{{ $prof->position }}</td>
                                <td>
                                    <a href="{{ route('editor.professional.edit', $prof->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('editor.professional.destroy', $prof->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No management found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
