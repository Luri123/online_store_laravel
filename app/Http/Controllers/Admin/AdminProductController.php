<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    //read
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Admin - Online Store";
        $viewData['products'] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }

    //create
    public function store(Request $request){
        Product::validate($request);

        $newProduct = new Product();
        $newProduct -> setName ($request->input('name'));
        $newProduct -> setPrice($request->input('price'));
        $newProduct -> setDescription($request->input('description'));
        $newProduct -> setImage('game.png');
        $newProduct->save();

        if($request->hasFile('image')){
            $imageName = $newProduct->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $newProduct->setImage($imageName);
            $newProduct->save();
        }

        return back();
    }


    //delete
    public function delete($id){
        Product::destroy($id);
        return back();
    }

    //edit
    public function edit($id){
        $viewData = [];
        $viewData['title'] = "Admin Page - Edit Product - Online Store";
        $viewData['products'] = Product::FindOrFail($id);
        return view('admin.product.edit')->with("viewData", $viewData);
    }

    //update
    public function update(Request $request,$id){
        Product::validate($request);

        $product = Product::findOrFail($id);
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));

        if($request->hasFile('image')){
            $imageName = $product->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($imageName);
        }

        $product->save();
        return redirect()->route('admin.product.index');
    }
}