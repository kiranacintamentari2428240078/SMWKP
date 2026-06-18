<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'rating' => 'required|integer|min:1|max:5',
            'detail_ulasan' => 'required|string',
            'foto_ulasan' => 'nullable|image|max:2048'
        ]);

        $photoPath = null;
        if ($request->hasFile('foto_ulasan')) {
            $photoPath = $request->file('foto_ulasan')->store('reviews', 'public');
        }

        Review::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $request->restaurant_id,
            'rating' => $request->rating,
            'comment' => $request->detail_ulasan,
            'photo' => $photoPath,
            'status' => 'visible',
        ]);

        return redirect()->route('wisatawan.detail-restoran', ['id' => $request->restaurant_id])
            ->with('success', 'Ulasan berhasil dikirim');
    }
}