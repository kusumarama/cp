@extends('layout.editor')
@section('title')
    Statistics
@endsection

@section('content')
<div id="content">

    <!-- Topbar -->
        @include('include.editor.topbar')
    <!-- End of Topbar -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Statistics</h1>
        
        <a href="{{ route('statistic.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Statistic
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Statistics</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Label (EN)</th>
                            <th>Label (ID)</th>
                            <th>Value</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($statistics as $stat)
                        <tr>
                            <td>{{ $stat->order }}</td>
                            <td>{{ $stat->label }}</td>
                            <td>{{ $stat->label_id }}</td>
                            <td>{{ $stat->value }}</td>
                            <td>
                                @if($stat->icon)
                                    <img src="{{ asset('storage/' . $stat->icon) }}" alt="icon" style="width: 50px; height: 50px; object-fit: contain;">
                                @else
                                    <span class="text-muted">No icon</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('statistic.edit', $stat->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('statistic.destroy', $stat->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this statistic?');">
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
                            <td colspan="6" class="text-center">No statistics found</td>
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
