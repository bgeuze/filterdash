@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Filters</h2>
        <form action="{{ route('filters.index') }}" method="GET" class="mb-3">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="search">Search</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Filter or Creator name..">
                </div>
                @if(auth()->user()->hasRole('admin'))
                <div class="col-md-4 mb-3">
                    <label for="client_id">Select Client</label>
                    <select class="form-control" id="client_id" name="client_id">
                        <option value="">All clients</option>
                        @if($clients)
                            @foreach($clients as $clientId => $clientName)
                                <option value="{{ $clientId }}">{{ $clientName }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                @endif
                <div class="col-md-2 mb-3">
                    <label></label>
                    <button type="submit" class="btn btn-primary btn-block">Zoeken</button>
                </div>
            </div>
        </form>
        @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('filters.create') }}" class="btn btn-primary mb-3">Add New Filter</a>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Creator Name</th>
                <th>Assigned Client</th>
                <th>Status</th>
                @if(auth()->user()->hasRole('admin'))
                    <th>Actions</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($filters as $filter)
                <tr>
                    <td>{{ $filter->id }}</td>
                    <td><a href="{{ route('filters.show', $filter->id) }}">{{ $filter->name }}</a></td>
                    <td>{{ $filter->creator_name }}</td>
                    <td>{{ $filter->user ? $filter->user->name : 'Not Assigned' }}</td>
                    @if(auth()->user()->hasRole('admin'))
                        <td>
                            <form action="{{ route('filters.update-status', $filter->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $filter->status === 'done' ? 'btn-success' : 'btn-secondary' }}"
                                        name="status" value="{{ $filter->status === 'done' ? 'in progress' : 'done' }}">
                                    {{ ucfirst($filter->status) }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('filters.edit', $filter->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('filters.destroy', $filter->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this filter?')">Delete</button>
                            </form>
                        </td>
                    @else
                        <td>
                            {{ ucfirst($filter->status) }}
                        </td>
                        <td>
                            <!-- Geen acties voor niet-admin gebruikers -->
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
