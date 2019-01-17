<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
class OrderController extends Controller
{
  function index(){
    $orders = Order::all();
    return view('admin.order.index',['orders'=> $orders]);
  }

  function editorder($id){
    $order = Order::find($id);
    return view('admin.order.editorder',['order'=>$order]);
  }

  function posteditorder(Request $request){
    $order = Order::find($request->id);

    $order->order_status = $request->order_status;
    $order->save();
    return redirect('admin/order/index');
  }
}
