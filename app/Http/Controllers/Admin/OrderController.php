<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Chart;
use Illuminate\Support\Carbon;

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

     public function chart($id)
     {
          $order_id = DB::table('order_product')->where('restaurant_id', $id)->pluck('order_id')->unique()->sortBy('created_at');

          $i = 0;
          foreach ($order_id as $value) {
               $array_order_id[] = $value;
               $i++;
          }

          $orders = Order::whereIn('id', $array_order_id)->orderby('created_at', 'ASC')->get();
          //dd($orders);

          $data = Order::whereIn('id', $array_order_id)->select('amount', 'created_at')->orderBy('created_at', 'ASC')->get()->groupBy(function ($data) {
               return Carbon::parse($data->created_at)->format('Y, M');
          });

          $data_amount = Order::whereIn('id', $array_order_id)->select('amount', 'created_at')->get()->SortBy('created_at');

          //ddd($data);
          $months = [];
          $monthOrders = [];
          foreach ($data as $month => $values) {
               $months[] = $month;
               $monthOrders[] = count($values);
          }

          $amounts = [];
          foreach ($data_amount as $amount => $values) {
               $amounts[] = $values->amount;
          }


          //dd($orders, $data, $months, $monthOrders, $amounts);

          return view('admin.restaurants.orders.chart', compact('id', 'months', 'monthOrders', 'amounts'));
     }
}
