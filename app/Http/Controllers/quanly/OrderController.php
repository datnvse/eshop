<?php

namespace App\Http\Controllers\quanly;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
class OrderController extends Controller
{
  function index(){
    $orders = Order::all();
    return view('quanly.order.index',['orders'=> $orders]);
  }

  function editorder($id){
    $order = Order::find($id);
    return view('quanly.order.editorder',['order'=>$order]);
  }

  function posteditorder(Request $request){
    $order = Order::find($request->id);

    $order->order_status = $request->order_status;
    $order->save();
    return redirect('quanly/order/index');
  }
}
