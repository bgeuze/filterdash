<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeFilter(Request $request, Filter $filter)
    {
        // Controleer of de gebruiker het filter al heeft geliked
        if ($filter->likes()->where('user_id', auth()->id())->exists()) {
            // Als de gebruiker al heeft geliked, verwijder dan de like
            $filter->likes()->where('user_id', auth()->id())->delete();
        } else {
            // Als de gebruiker nog niet heeft geliked, voeg dan een like toe
            Like::create([
                'user_id' => auth()->id(),
                'filter_id' => $filter->id,
            ]);
        }

        // Redirect terug naar de vorige pagina met een succesbericht
        return redirect()->back()->with('success', 'Filter liked/unliked successfully.');
    }
}

