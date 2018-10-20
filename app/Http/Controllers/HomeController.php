<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Intervention\Image\ImageServiceProvider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
/**/
    public function fileUpload() {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $pathToFile = '/public/img_upload/test.jpg';

        $image = Image::make(Input::file($request->file('image')->getRealPath())
            ->resize(870, null, true, false)
            ->save($pathToFile));

    }
/**/
}
