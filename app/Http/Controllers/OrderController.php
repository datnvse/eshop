<?php

namespace App\Http\Controllers;

use App\Order;
use App\LineItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function new(){
        return view('pages.checkout');
    }
    function create(Request $request){
        $order = new Order;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->order_code = $request->order_code;
        $order->user_id = $request->user_id;
        $order->total_price = $request->subtotal;
        $order->description = $request->description;

        $order->save();

        foreach (session('cart') as $id => $details) {
            $line_item = new LineItem;
            $line_item->order_id = $order->id;
            $line_item->product_id = $id;
            $line_item->quantity = $details['quantity'];
            $line_item->price = $details['promotionprice']*$details['quantity'];

            $line_item->save();
        }
        $request->session()->forget('cart');
        return redirect('home');
    }

    function list(){
        $user = Auth::user();
        $orders = Order::where('user_id',$user->id)->get();
        return view('pages.orders_list',['orders'=>$orders]);
    }

    function deleteorder($id){
        $order = Order::find($id);
        $order->delete();
        return redirect('orderslist');
    }
}
