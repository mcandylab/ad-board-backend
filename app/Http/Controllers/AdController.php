<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Ad::class);

        $ads = Ad::where('user_id', Auth::id())->with(['user', 'media'])->latest()->paginate(3);

        return response()->json($ads);
    }

    public function show(Ad $ad)
    {
        $this->authorize('view', $ad);

        return response()->json($ad->load(['user', 'media']));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Ad::class);

        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'images' => 'required|array|min:1|max:10',
            'images.*' => 'image|max:2048|mimes:jpeg,png,jpg'
        ]);

        $ad = Ad::create([
            'user_id' => Auth::id(),
            'name' => $validated['name']
        ]);

        foreach ($validated['images'] as $image) {
            $ad->addMedia($image)->toMediaCollection('images');;
        }

        return $ad;
    }
}
