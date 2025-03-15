<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image; // Import the Image model

class ImageController extends Controller
{
    // Display the upload form
    public function index()
    {
        return view('upload');
    }

    // Handle the upload and save data to the database
    public function store(Request $request)
    {
        // Validate that an image file is provided
        $request->validate([
            'image' => 'required|mimes:jpg,png,pdf|max:2048', // maximum file size of 2MB
        ]);

        $file = $request->file('image');
        // Get the original filename before storing the file
        $filename = $file->getClientOriginalName();
        // Store the file in the "upload" directory inside the public disk
        $path = $file->storeAs('upload', $filename, 'public');

        // Save file details in the database
        Image::create([
            'filename' => $filename,
            'path'     => $path,
        ]);

        return back()->with('success', 'Image uploaded successfully!');
    }
    
    public function showImages()
    {
        $images = Image::all();
        return view('images', compact('images'));
    }
}
