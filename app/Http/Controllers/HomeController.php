<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index(){
        $viewData = [];
        $viewData["title"] = "Laravel Store";
        return view("home.index")->with("viewData",$viewData);
    }

    public function about(){
        $viewData = [];
        $viewData["subtitle"] = "About Us";
        $viewData["description"] = "This is an about page..." ;
        $viewData["name"] = "This is developed by: Adhurim Quku";
        return view("home.about")->with("viewData",$viewData);
    }
}
