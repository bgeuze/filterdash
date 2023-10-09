<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $filters = Filter::all();
        return view('filters.index', compact('filters'));
    }

    public function create()
    {
        return view('filters.create');
    }

    public function store(Request $request)
    {
        $filter = new Filter($request->all());
        $filter->save();

        return redirect()->route('filters.index')->with('success', 'Filter created successfully!');
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
}
