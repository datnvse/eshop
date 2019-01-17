<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class PagesController extends Controller
{
  function home(){
    $str = "home";
    $lastest_products = Product::orderBy('id','desc')->take(12)->get();
    return view('pages.home',['home'=>$str, 'lastest_products'=> $lastest_products]);
  }

  function detailproduct(){
    return view('pages.detailproduct');
  }

  function products(){
    return view('pages.products');
  }
}
