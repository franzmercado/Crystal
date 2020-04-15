<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use App\User;
use App\Order;
use App\Product;
use DB;
use App\Libraries\myFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
  public function index(){
    if (request()->ajax()) {
    $transacs = Transaction::select('*')->get();
    return datatables()->of($transacs)
          ->editColumn('name', function($data){
            $user = User::find($data->userID);
            $myFunctions = new myFunctions();
            $name = $myFunctions->concatname($user->lastName,$user->firstName,$user->midName);
            return $name;

            return 1;
          })
          ->editColumn('status', function($data){
            $myFunctions = new myFunctions();
            $stats = $myFunctions->orderStatus($data->status);
            return $stats;
          })
          ->editColumn('total', function($data){
            $total = '₱'.number_format($data->total, 2, '.', ', ');
            return $total;
          })
          ->addColumn('action', function($data){
            switch ($data->status) {
              case 1:
                      $button = '<button class="btn btn-sm btn-info shwOrder" id="'.$data->transactionID.'"><i class="fa fa-eye fa-lg"></i></button>';
                      $button .= ' ';
                      $button .= '<button class="btn btn-sm btn-danger cnclOrder" id="'.$data->transactionID.'"><i class="fas fa-backspace fa-lg"></i></button>';
                      $button .= ' ';
                      $button .= '<button class="btn btn-sm btn-success actBtn" id="'.$data->transactionID.'">Accept</button>';

                      break;
              case 2:
                      $button = '<button class="btn btn-sm btn-info shwOrder" id="'.$data->transactionID.'"><i class="fa fa-eye fa-lg"></i></button>';
                      $button .= ' ';
                      $button .= '<button class="btn btn-sm btn-danger cnclOrder" id="'.$data->transactionID.'"><i class="fas fa-backspace fa-lg"></i></button>';
                      $button .= ' ';
                      $button .= '<button class="btn btn-sm btn-success shpBtn" id="'.$data->transactionID.'">Ship</button>';
              break;
              case 3:
                      $button = '<button class="btn btn-sm btn-info shwOrder" id="'.$data->transactionID.'"><i class="fa fa-eye fa-lg"></i></button>';
                      $button .= ' ';
                      $button .= '<button class="btn btn-sm btn-danger cnclOrder" id="'.$data->transactionID.'"><i class="fas fa-backspace fa-lg"></i></button>';
                      $button .= ' ';
                      $button .= '<button class="btn btn-sm btn-success delBtn" id="'.$data->transactionID.'">Deliver</button>';
                      break;
              case 4:
                      $button = '<button class="btn btn-sm btn-info shwOrder" id="'.$data->transactionID.'"><i class="fa fa-eye fa-lg"></i></button>';
                      break;
              default:
                      $button = '<button class="btn btn-sm btn-info shwOrder" id="'.$data->transactionID.'"><i class="fa fa-eye fa-lg"></i></button>';
                      break;
            }
            return $button;
          })
          ->rawColumns(['action', 'status'])
          ->make(true);
     }

    return view('admin.orders')->with(['exJS'=>1,
      'special_js' => 'admins',
      'custom_js' => 'order'
    ]);

  }
  public function showOrders($id){
    $data = array();
    $data['list'] = DB::table('orders')
              ->join('products', 'orders.prodID', '=', 'products.prodID')
              ->select('products.*', 'orders.*')
              ->where('orders.transactionID', $id)
              ->get();

    $info = DB::table('transactions')
              ->join('users', 'transactions.userID', '=', 'users.userID')
              ->join('userinfo', 'users.userID', '=', 'userinfo.userID')

              ->select('transactions.total', 'transactions.created_at', 'users.firstName', 'users.midName', 'users.lastName', 'userinfo.mobileNum',
              'userinfo.buldingNum','userinfo.brgy','userinfo.city', 'userinfo.province')
              ->where('transactions.transactionID', $id)
              ->take(1)->get();

    $data['info']['total'] = number_format($info[0]->total, 2, '.', ', ');
    $data['info']['contact'] = $info[0]->mobileNum;

    $myFunctions = new myFunctions();
    $data['info']['name'] = $myFunctions->concatname($info[0]->lastName,$info[0]->firstName,$info[0]->midName);
    $data['info']['address'] = $myFunctions->makeAddress($info[0]->buldingNum,$info[0]->brgy,$info[0]->city,$info[0]->province);

    $data['info']['date'] = $myFunctions->converDate($info[0]->created_at);

    return response()->json(['success' => $data]);

  }
  public function cancelOrder(Request $request, $id){

    $orders = Order::where('transactionID', $id)->get();

    foreach ($orders as $order) {
      $quantity = Product::select('quantity')->where('prodID', $order->prodID)->first();
      $new = $quantity->quantity + $order->quantity;
      $prod = Product::find($order->prodID);
      $prod->quantity = $new;
      $prod->update();
    }
    $data = Transaction::findOrFail($id);
    $data->status = 0;
    $data->update();

    return response()->json(['success' => ' Transaction Cancelled']);
  }
  public function acceptOrder(Request $request, $id){

    $orders = Order::where('transactionID', $id)->get();
    foreach ($orders as $order) {
      $quantity = Product::select('quantity')->where('prodID', $order->prodID)->first();
      if ($quantity->quantity < $order->quantity)
        return response()->json(['error' => 'Low on stocks!']);
      }
    foreach ($orders as $order) {
      $quantity = Product::select('quantity')->where('prodID', $order->prodID)->first();
      $new = $quantity->quantity - $order->quantity;
      $prod = Product::find($order->prodID);
      $prod->quantity = $new;
      $prod->update();
    }

    $data = Transaction::findOrFail($id);
    $data->status = 2;
    $data->update();

    return response()->json(['success' => ' Transaction Updated!']);
  }
  public function shipOrder(Request $request, $id){

    $data = Transaction::findOrFail($id);
    $data->status = 3;
    $data->update();

    return response()->json(['success' => ' Transaction Updated!']);
  }
  public function deliverOrder(Request $request, $id){

    $orders = Order::where('transactionID', $id)->get();

    foreach ($orders as $order) {
      $sold = Product::select('sold')->where('prodID', $order->prodID)->first();
      $new = $sold->sold + $order->quantity;
      $prod = Product::find($order->prodID);
      $prod->sold = $new;
      $prod->update();
    }

    $data = Transaction::findOrFail($id);
    $data->dateFinished = date('Y-m-d');
    $data->status = 4;
    $data->update();

    return response()->json(['success' => ' Transaction Updated!']);
  }
}
