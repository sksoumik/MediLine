<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index(){ 
        $title = 'Welcome to MediLine!!';
        // return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'This  the about page!!';
        return view('pages.about')->with('title',$title);
    }

    public function services(){
        $data =[
            'title'=> 'Services',
            'services' => ['web design', 'programming', 'seo']
        ];

        $title = 'This  the services page!!';
        return view('pages.services')->with($data);
    }


}
