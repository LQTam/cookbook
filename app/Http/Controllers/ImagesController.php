<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageFormRequest;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    public function store(ImageFormRequest $request){
        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $imagePath = public_path().'/images/'.$name;
            // $file->move(public_path().'/images/',$name);
            $image = Image::make($imagePath)->resize(1000,250)->save();

            return redirect(route('home'))->with('status','Your image has been uploaded successfully!');
        }
    }
}
