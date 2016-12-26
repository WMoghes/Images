<?php

namespace App\Http\Controllers;

use App\Crop;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    /**
     * To display all images according position
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $images = DB::table('images')->orderBy('position', 'asc')->get();
        return view('show', compact('images'));
    }

    /**
     * To store all images into (public/images)
     * @param Request $request
     */
    public function store(Request $request)
    {
        $path = public_path('images/');
        $files = $request->file('file');
        $getTheLastPosition = DB::table('images')->orderBy('position', 'desc')->first();
        if(empty($getTheLastPosition->position)){
            $maxPosition = 0;
        }else {
            $maxPosition = $getTheLastPosition->position;
        }
        if($files){
            foreach ($files as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $filename);

                Photo::create([
                    'image_name'            => $filename,
                    'image_original_name'   => $file->getClientOriginalName(),
                    'image_size'            => $file->getClientSize(),
                    'image_type'            => $file->getClientMimeType(),
                    'position'              => $maxPosition
                ]);
                $maxPosition++;
            }
        }
    }

    public function setPosition(Request $request)
    {
        /*
         * value = id && postion = key
         */
        $arr = $request->all();
//        dd($arr['item']);
        foreach ($arr['item'] as $key => $value) {
            Photo::whereId($value)->update(['position' => $key]);
        }
    }

    /**
     * Displaying all images to select one of them to edit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll()
    {
        $images = DB::table('images')->orderBy('position', 'asc')->get();
        return view('show_all', compact('images'));
    }

    /**
     * To display all crops we have for a specific user
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllCrops($id)
    {
        $crops = Crop::where('photo_id', $id)->get();
        return view('display_crops', compact('crops'));
    }

    /**
     * Display the image for a specific user to start crop it
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $image = Photo::findOrFail($id);
        return view('edit', compact('image'));
    }

    /**
     * This method for add a new row inside crops table for each new crop
     * @param Request $request
     * @param $id
     */

    public function cropImage(Request $request, $id)
    {
//        dd($request->all());
        $image = Photo::findOrFail($id);
        $filename = time() . '_crop_' . $image->image_original_name;

        $pathForCrop = public_path('images/imagesAfterCroped/' . $filename);
        $pathImage = public_path('images/' . $image->image_name);

        $img = Image::make($pathImage);
        $img->crop(intval($request->width),intval($request->height),intval($request->x),intval($request->y));
        $img->save($pathForCrop, 100);

        Crop::create(['photo_id' => $id, 'crop_image_name' => $filename]);
    }
}
