<?php

namespace App\Http\Controllers;

use App\Authorizable;

use App\Image;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Tag;

use Intervention\Image\ImageServiceProvider;

use Illuminate\Support\Facades\Input;

use Image;

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
        $result = \Image::paginate();
        return view('image.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tagsDropDown = Tag::pluck('name', 'id');
        return view('image.new', compact('tagsDropDown'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
// simple method (generic)
        $image = $request->file('image');
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
        $destPath = public_path('/img_upload');
        $image->move($destPath, $input['imagename']);
// simple method (generic)

// store and resize image using Image (intervention)
if($request->hasFile('image')) {
        //get filename with extension
        $filenamewithextension = $request->file('image')->getClientOriginalName();
 
        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
 
        //get file extension
        $extension = $request->file('image')->getClientOriginalExtension();
 
        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;
 
        //Upload File
        //dd($request->file('image')->storeAs('public/img_upload/', $filenametostore, $filenametostore));
        dd(Storage::putFile('public/img_upload', $request->file('image')));
        $request->file('image')->storeAs('public/img_upload/thumbnail', $filenametostore);
 
        //Resize image here
        $thumbnailpath = public_path('storage/img_upload/thumbnail/'.$filenametostore);
        $img = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);
 
        return redirect('images')->with('success', "Image uploaded successfully.");
    }
// store and resize image using Image (intervention)


        $tags = $request->input('tags'); 
        $all_tags= implode(",",$tags);
        //Image::make($request->file('image'))->resize(300, 200)->save($input['imagename']);
        //Image::make(Input::file('photo'))->resize(300, 200)->save($input['imagename']);
        $image->url = $destPath . $input['imagename'];
        $image->tags = $all_tags;
        $image->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
