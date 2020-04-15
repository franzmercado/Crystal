<?php

namespace App\Http\Controllers;
use Auth;
use App\Cart;
use App\Product;
use App\Transaction;
use App\Order;
use App\User;
use App\Userinfo;
use App\Libraries\myFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
  /**
 * Create a new controller instance.
 *
 * @return void
 */
 public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    if (request()->ajax()) {
      $userID = Auth::id();
      $details = DB::table('users')
          ->join('userinfo', 'users.userID', '=', 'userinfo.userID')
          ->select('users.*', 'userinfo.*')
          ->where('users.userID', '=',$userID)
          ->get();
      return $details;
    }
      return view('profile')->with([
        'nav' => 2,
        'sjs' => 1,
        'special_js' => 'main',
        'custom_js'  => 'profile',
  ]);

  }
  public function carts()
  {
    return view('cart')->with([
    'nav' => 1,
    'special_js' => 'main',
    'custom_js'  => 'cart '
    ]);
  }
  public function getCarts()
  {
    if (request()->ajax()) {
      $savedItems = array();
      $userID = Auth::id();

      $savedItems = DB::table('carts')
          ->join('products', 'carts.prodID', '=', 'products.prodID')
          ->join('categories', 'products.categoryID', '=', 'categories.id')
          ->select('*', 'carts.id','carts.quantity')
          ->where('carts.userID', '=',$userID)
          ->get();

      return $savedItems;
    }
  }

  public function addToCart(Request $request)
  {
  $data = new Cart;
  $data->userID = Auth::id();
  $data->prodID = $request->id;
  $data->save();
   return response()->json(['success' => 'Added!']);
  }
  public function removeToCart($id)
  {
    if (request()->ajax()) {
      $data = Cart::findOrFail($id);
      $data->delete();
      return response()->json(['success' => '1']);
    }
  }

  public function checkOut(Request $request)
  {
    $rec = $request->all();

    $prod = array();
    $price = array();
    $qty = array();
    $products = array();
    $total = $rec['ctr'];
    foreach ($rec['prod'] as $value) {
      $selProd =  Product::findOrFail($value);
      $prod[] = $selProd['brandName'];
      // $prod['name'][] = $selProd['price'];
    }
    foreach ($rec['prod'] as $value) {
      $selProd =  Product::findOrFail($value);
      $price[] = $selProd['price'];
      // $prod['name'][] = $selProd['price'];
    }

    foreach ($rec['valQtys'] as $value) {
      $qty[] =  $value;
    }
    foreach ($prod as $key => $value) {
      $products[] = [$value, $price[$key], $qty[$key]];
    }

    $uID = Auth::id();
    $users = DB::table('users')
              ->join('userinfo', 'users.userID', '=', 'userinfo.userID')
              ->select('users.firstName', 'users.midName', 'users.lastName', 'userinfo.mobileNum',
              'userinfo.buldingNum','userinfo.brgy','userinfo.city', 'userinfo.province')
              ->where('users.userID', $uID)
              ->take(1)->get();
    // echo json_encode($users);die;
    $myFunctions = new myFunctions();
    $ads = $myFunctions->makeAddress($users[0]->buldingNum,$users[0]->brgy, $users[0]->city,$users[0]->province);

      return view('checkout')->with([
        'nav' => 2,
        'sjs' => 1,
        'special_js' => 'main',
        'custom_js'  => 'cart',
        'products' => $products,
        'total' => $total,
        'address' => $ads
  ]);

  }
  public function placeOrder(Request $request)
  {

    $data = Auth::id();

    $result = Cart::all()->where('userID',$data);
    $ptotal =0;
    $total = 0;
    foreach ($result as $value) {
      $total = DB::table('carts')
          ->join('products', 'carts.prodID', '=', 'products.prodID')
          ->select('*', 'carts.quantity')
          ->where('carts.id', '=',$value['id'])
          ->get();

            $ptotal = $ptotal + ($total[0]->price * $total[0]->quantity);

    }
    if($ptotal <= 999){
      $ptotal = $ptotal + 50;
    }

    $transac = new Transaction;
    $myFunctions = new myFunctions();
    $transactionID = $myFunctions->transacID();
    $transac->transactionID = $transactionID;
    $transac->userID = Auth::id();
    $transac->total = $ptotal;
    $transac->save();

    foreach ($result as $value) {
      $data = new Order;
      $data->transactionID = $transactionID;
      $data->prodID = $value['prodID'];
      $data->quantity = $value['quantity'];
      $data->save();

      $del = Cart::find($value['id']);
      $del->delete();

    }

   return response()->json(['success' => 'Order placement Complete']);
  }
  public function changeQty(Request $request)
  {
    $pro = $request->prod;
    $qty = $request->qty;

    $data = Cart::find($pro);
    $data->quantity = $qty;
    $data->save();

   return response()->json(['success' => 1]);
  }
}
