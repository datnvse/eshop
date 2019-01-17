<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
  function index(){
    $products = Product::all();
    return view('admin.product.index', ['products' => $products]);
  }
  function newproduct(){
    return view('admin.product.new');
  }
  function create(Request $request){
    $this->validate($request,
      [
        'name' => 'required',
        'price' => 'required',
        'description' => 'required',
        'discount' => 'required'
      ],
      [
        'name.required' => 'Product name cant be blank',
        'price.required' => 'Product price cant be blank',
        'description.required' => 'Product description cant be blank',
        'discount.required' => 'Product discount cant be blank',
      ]
    );

    $product = new Product;
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->discount = $request->discount;

    if ($request->hasFile('image')) {
      $file = $request->file('image');
      $extension_file = $file->getClientOriginalExtension();
      if ($extension_file != 'jpg' && $extension_file != 'jpeg' && $extension_file != 'png' ) {
        return redirect('admin/user/new'); 
      }
      $name = $file->getClientOriginalName();
      $filename = str_random(5)."_".$name;
      while(file_exists('upload/images/'.$filename)){
        $filename = str_random(5)."_".$name;
      }
      $file->move('upload/images',$filename);
      $product->image = $filename;
    }else{
      $product ->image = "product01.jpg";
    }
    $product->save();
    return redirect('admin/product/index');
  }

  function edit($id){
    $product = Product::find($id);
    return view('admin/product/edit', ['product' => $product]);
  }

  function update($id, Request $request){
    $product = Product::find($id);
    $this->validate($request,
      [
        'name' => 'required',
        'price' => 'required',
        'description' => 'required',
        'discount' => 'required'
      ],
      [
        'name.required' => 'Product name cant be blank',
        'price.required' => 'Product price cant be blank',
        'description.required' => 'Product description cant be blank',
        'discount.required' => 'Product discount cant be blank',
      ]
    );
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->discount = $request->discount;

    if ($request->hasFile('image')) {
      $file = $request->file('image');
      $extension_file = $file->getClientOriginalExtension();
      if ($extension_file != 'jpg' && $extension_file != 'jpeg' && $extension_file != 'png' ) {
        return redirect('admin/user/new'); 
      }
      $name = $file->getClientOriginalName();
      $filename = str_random(5)."_".$name;
      while(file_exists('upload/images/'.$filename)){
        $filename = str_random(5)."_".$name;
      }
      $file->move('upload/images',$filename);
      $product->image = $filename;
    }
    $product->save();
    return redirect('admin/product/index');
  }

  function delete($id){
    $product = Product::find($id);
    $product->delete();
    return redirect('admin/product/index');
  }
}