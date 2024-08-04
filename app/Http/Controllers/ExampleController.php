<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    function login() {
        return view('login');
    }

    function contactUs() {
        return view('contactUs');
    }

    function recieve(Request $request) {
        //dd($request);
        //return "data recieved";
        return $request->name . '<br>' . $request->email . '<br>' . $request->subject . '<br>' . $request->message;
    }

    function cv () {
        return view('cv');
    }

    function uploadForm () {
        return view('upload');
    }

    public function upload(Request $request){
        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'assets/images';
        $request->image->move($path, $file_name);
        return 'Uploaded';
    }
}