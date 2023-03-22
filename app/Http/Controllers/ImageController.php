<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function indexImage()
    {
        return view('/image');
    }

    public function storeImage(Request $request)
    {
        
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $filename = $request->description.time() . '.' . $request->file('image')->getClientOriginalExtension();
        $image_path = $request->file('image')->storeAs('image/Test', $filename, 'public');
        // $image_path = $request->file('image')->store( 'image/Test/', 'public');
        
        $data = Image::create([
            'image' => $image_path,
        ]);

        session()->flash('success', 'Image Upload successfully');
        \Log::info(json_encode($request->all()));
        \Log::info(json_encode($data->image));
        \Log::info(json_encode($image_path));
        return redirect()->route('image.index');
    }

    public function showAllImages(){
        return view('/image', ['imageList' => Image::all()]);
    }
}
