<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = public_path('images/');
        $files = $request->file('file');

        if($files){
            foreach ($files as $file) {
//                echo $path . $file->getClientOriginalName();
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $filename);

                Image::create([
                    'image_name'            => $filename,
                    'image_original_name'   => $file->getClientOriginalName(),
                    'image_size'            => $file->getClientSize(),
                    'image_type'            => $file->getClientMimeType(),
                ]);
            }

        }

//        if($request->hasFile('file')){
//            $image = $request->file('avatar');
//            $filename = time() . '.' . $image->getClientOriginalExtension();
//            $path = public_path('images/' . $filename);
//            Image::make($image)->resize(300, 300)->save($path);
//
//            $images = Image::create();
//        }
//        dd($request->file[0]->getClientOriginalExtension());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
