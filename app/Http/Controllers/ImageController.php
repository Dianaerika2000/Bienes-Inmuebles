<?php

namespace App\Http\Controllers;

use App\Models\Inmueble;
use App\Models\InmuebleImage;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index($id){
        $inmueble = Inmueble::find($id);
        $images = $inmueble->images;
        return view('images.index', compact('inmueble', 'images'));
    }

    public function store(Request $request, $id){
        // guardar la img en nuestro proyecto
        $file = $request->file('photo');
        $path = public_path().'/images/inmuebles';
        $fileName = uniqid().$file->getClientOriginalName();
        $moved = $file->move($path, $fileName);

        // crear 1 registro en la tabla inmueble_images
        if ($moved) {
            $inmuebleImage = new InmuebleImage();
            $inmuebleImage->image = $fileName;
            $inmuebleImage->inmueble_id = $id;
            $inmuebleImage->save();
        }

        return back();
    }

    public function destroy(Request $request, $id){
        // eliminar el archivo
        $inmuebleImage = InmuebleImage::find($request->image_id);
        if (substr($inmuebleImage->image, 0, 4) === "http") {
            $deleted = true;
        }else{
            $fullPath = public_path().'/images/inmuebles/' . $inmuebleImage->image;
            $deleted = File::delete($fullPath);
        }

        // eliminar el registro de la img en la bd
        if($deleted){
            $inmuebleImage->delete();
        }

        return back();
    }
}
