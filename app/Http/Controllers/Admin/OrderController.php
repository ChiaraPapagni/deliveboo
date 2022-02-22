<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class OrderController extends Controller
{
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
          //ddd($id);
          $order_id = DB::table('order_product')->where('restaurant_id', $id)->pluck('order_id')->unique();

          $i = 0;
          foreach ($order_id as $value) {
               $array_order_id[] = $value;
               $i++;
          }

          $orders = Order::whereIn('id', $array_order_id)->orderby('created_at', 'DESC')->get();


          //dd($id, $order_id, $array_order_id, $orders);

          return view('admin.restaurants.orders.index', compact('orders'));
     }
}
