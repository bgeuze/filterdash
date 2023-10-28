@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                        @if(auth()->user()->hasRole('admin'))
                            <div>
                                {{ __('Your role is Admin') }}
                            </div>
                        @elseif(auth()->user()->hasRole('client'))
                            <div>
                                {{ __('Your role is Client') }}
                            </div>
                        @else
                            <div>
                                {{ __('You do not have any assigned roles.') }}
                            </div>
                        @endif

                        <div class="mt-3">
                            {{ __('Total Likes Given: ') }} {{ auth()->user()->likes->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h2>All Filters</h2>
                <ul class="list-group">
                    @foreach($filters as $filter)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                {{ $filter->name }}
                                <span class="badge badge-primary" style="background-color: royalblue; color: white">Likes: {{ $filter->likes_count }}</span>
                            </div>
                            <div class="d-flex">
                                <a href="{{ htmlspecialchars($filter->filter_unlock_link) }}" target="_blank" class="btn btn-sm btn-outline-primary" style="margin-right: 8px;">Try filter</a>

                                <form action="{{ route('filters.like', $filter->id) }}" method="POST">
                                    @csrf
                                    @if(auth()->user()->likes->where('filter_id', $filter->id)->count() > 0)
                                        <button type="submit" class="btn btn-sm btn-primary">Liked</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Like</button>
                                    @endif
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
