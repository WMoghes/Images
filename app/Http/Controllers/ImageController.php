<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $images = DB::table('images')->orderBy('position', 'asc')->get();
        return view('show', compact('images'));
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
        $getTheLastPosition = DB::table('images')->orderBy('position', 'desc')->first();
        if(empty($getTheLastPosition->position)){
            $maxPosition = 0;
        }else {
            $maxPosition = $getTheLastPosition->position;
        }
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
            Image::whereId($value)->update(['position' => $key]);
        }
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

    public function showAll()
    {
        $images = DB::table('images')->orderBy('position', 'asc')->get();
        return view('show_all', compact('images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('edit', compact('image'));
    }

    public function cropImage(Request $request)
    {
        dd($request->all());
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
