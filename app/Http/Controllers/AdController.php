<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::with(['user', 'media'])->latest()->paginate(3);

        return response()->json($ads);
    }

    public function show(Ad $ad)
    {
        return response()->json($ad->load('user'));
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store(Request $request)
    {
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
