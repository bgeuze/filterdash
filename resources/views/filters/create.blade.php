@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Create Filter</h2>
        <form action="{{ route('filters.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="creator_name">Creator Name:</label>
                <input type="text" class="form-control" id="creator_name" name="creator_name" required>
            </div>
            <div class="form-group">
                <label for="creator_social_media">Creator Social Media:</label>
                <input type="text" class="form-control" id="creator_social_media" name="creator_social_media">
            </div>
            <div class="form-group">
                <label for="filter_unlock_link">Filter Unlock Link:</label>
                <input type="text" class="form-control" id="filter_unlock_link" name="filter_unlock_link">
            </div>
            <button type="submit" class="btn btn-primary">Create Filter</button>
        </form>
    </div>
@endsection
