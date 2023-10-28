<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $filtersQuery = Filter::query();

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $filtersQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('creator_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('creator_social_media', 'like', '%' . $searchTerm . '%');
//                    ->orWhere('user_id', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by client
        if ($request->filled('client_id')) {
            $clientId = $request->input('client_id');
            $filtersQuery->where('user_id', $clientId);
        }

        if ($user->hasRole('admin')) {
            $filters = $filtersQuery->get();
            $clients = User::whereHas('roles', function ($query) {
                $query->where('name', 'client');
            })->pluck('name', 'id');
        } elseif ($user->hasRole('client')) {
            // Clients can only see their own filters
            $filters = $filtersQuery->where('user_id', $user->id)->get();
            $clients = null;
        } else {
            // Handle other roles as needed
            $filters = [];
            $clients = null;
        }

        return view('filters.index', compact('filters', 'clients'));
    }

    public function create()
    {
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->get();

        return view('filters.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'creator_name' => 'required|string|max:255',
            'creator_social_media' => 'required|string|max:255',
            'filter_unlock_link' => 'required|string|max:255',
        ];

        $request->validate($rules);

        $filter = Filter::create([
            'name' => $request->input('name'),
            'creator_name' => $request->input('creator_name'),
            'creator_social_media' => $request->input('creator_social_media'),
            'filter_unlock_link' => $request->input('filter_unlock_link'),
            'user_id' => $request->input('user_id'),
        ]);

        return redirect()->route('filters.index')->with('success', 'Filter created successfully.');
    }

    public function edit(Filter $filter)
    {
        return view('filters.edit', compact('filter'));
    }

    public function update(Request $request, Filter $filter)
    {
        $filter->update($request->all());

        return redirect()->route('filters.index')->with('success', 'Filter updated successfully!');
    }

    public function destroy(Filter $filter)
    {
        $filter->delete();

        return redirect()->route('filters.index')->with('success', 'Filter deleted successfully!');
    }

    public function updateStatus(Filter $filter)
    {
        $filter->status = $filter->status === 'in progress' ? 'done' : 'in progress';
        $filter->save();

        return redirect()->route('filters.index')->with('success', 'Filter status updated successfully.');
    }

    public function show(Filter $filter)
    {
        $filter->load('comments.user');

        return view('filters.show', compact('filter'));
    }
}
