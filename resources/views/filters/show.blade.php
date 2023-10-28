@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Filter Details</h2>
        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $filter->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $filter->name }}</td>
            </tr>
        </table>
    </div>
    <div style="background-color: lightgray; border-radius: 5px; padding: 10px;" class="container mt-5">
        @forelse($filter->comments as $comment)
                <div style="float: left;">
                    <strong>{{ $comment->user->name }}</strong>:
                    {{ $comment->body }}
                </div>
                <div style="float: right;">
                    {{ $comment->created_at->diffForHumans() }}
                </div>
                <div style="clear: both;"></div>
        @empty
            No comments yet.
        @endforelse
    </div>
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(auth()->user()->likes->count() >= 3)
            <form action="{{ route('filters.comments.store', $filter->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="body">Add a Comment</label>
                    <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        @else
            <div class="alert alert-info">
                You need to give at least <b>3</b> likes across filters to place a comment. You gave <b>{{ auth()->user()->likes->count() }}</b> like(s) so far.
            </div>
        @endif
    </div>
@endsection
