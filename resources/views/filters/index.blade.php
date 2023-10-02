@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Filters</h2>
        <a href="{{ route('filters.create') }}" class="btn btn-primary mb-3">Add New Filter</a>

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
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($filters as $filter)
                <tr>
                    <td>{{ $filter->id }}</td>
                    <td>{{ $filter->name }}</td>
                    <td>{{ $filter->creator_name }}</td>
                    <td>
                        <a href="{{ route('filters.edit', $filter->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('filters.destroy', $filter->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this filter?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
