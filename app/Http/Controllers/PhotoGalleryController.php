<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        $photos = PhotoGallery::get();
        return view('photo_gallery.index', compact('photos'));
    }

    public function create()
    {
        return view('photo_gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'required|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $path = $request->file('photo')->store('photo_gallery', 'public');

        if ($request->hasFile('photo')) {
            $logoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('image/photoGalery'), $logoName);
        }
        // if ($request->hasFile('slider_images')) {
        //     $imageName = time() . '.' . $request->slider_images->extension();
        //     $request->slider_images->move(public_path('admin/slidres/'), $imageName);
        // }


        PhotoGallery::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'photo' => $logoName,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('photo_gallery.index')->with('success', 'Photo added successfully!');
    }

    public function edit(PhotoGallery $photoGallery)
    {
        return view('photo_gallery.edit', compact('photoGallery'));
    }

    public function update(Request $request, PhotoGallery $photoGallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($request->hasFile('photo')) {
            $image_path = public_path("image/photoGalery/") . $photoGallery->photo;
            if (file_exists($image_path)) {
                @unlink($image_path);
            }

            $logoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('image/photoGalery'), $logoName);
            $photoGallery->update(['photo' => $logoName]);
        }

        $photoGallery->title = $request->title;
        $photoGallery->status = $request->status ?? 1;
        $photoGallery->save();

        return redirect()->route('photo_gallery.index')->with('success', 'Photo updated successfully!');
    }

    public function destroy(PhotoGallery $photoGallery)
    {
        $photoGallery->delete();

        $image_path = public_path("image/photoGalery/") . $photoGallery->photo;
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        return redirect()->route('photo_gallery.index')->with('success', 'Photo deleted successfully!');
    }
}
