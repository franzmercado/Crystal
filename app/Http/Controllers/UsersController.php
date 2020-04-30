<?php

namespace App\Http\Controllers;
use Auth;
use App\Cart;
use App\Product;
use App\Transaction;
use App\Order;
use App\User;
use App\Userinfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
          ->select('*', 'carts.id','carts.quantity as qty')
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
      $usrID = '';
      $data = Cart::findOrFail($id);
      $usrID = $data->userID;
      $data->delete();
      $items = Cart::where('carts.userID', '=',$usrID)->count();

      return $items;
    }
  }

  public function checkOut(Request $request)
  {
    if ($request->has('_token')) {
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
      if(empty($users[0]->brgy)){
        $ads = 'Please provide your delivery address.';
        $stat = 0;
      }else{
        $ads = $myFunctions->makeAddress($users[0]->buldingNum,$users[0]->brgy, $users[0]->city,$users[0]->province);
        $stat = 1;

      }

        return view('checkout')->with([
          'nav' => 2,
          'sjs' => 1,
          'special_js' => 'main',
          'custom_js'  => 'cart',
          'products' => $products,
          'total' => $total,
          'stat' => $stat,
          'address' => $ads
    ]);
    } else {
      abort(403, "Sorry, you cannot access this page directly!");
    }


  }

  public function checkStocks(){
    $userID = Auth::id();
    $ctr = 0;
    $name = array();

    $cartItems = DB::table('carts')
                ->select('prodID', DB::raw('sum(quantity) as total'))
                ->groupBy('prodID')
                ->get();
    // echo $cartItems;
    // die;
    foreach ($cartItems as $value) {
      $prods = Product::where('prodID', $value->prodID)->first();
      if ($value->total > $prods->quantity) {
        $ctr++;
        $name[] = $prods->brandName;
      }else {

      }
    }
    if ($ctr<1) {
      return 'true';
    }else {
      return $name;

    }
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

   return response()->json(['success' => 'Order placement complete!']);
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

  public function orders()
  {
    if (request()->ajax()) {
    $userID = Auth::id();
    $transacs = Transaction::select('*')->where('userID', $userID)->orderBy('created_at','DESC')->get();
    return datatables()->of($transacs)
          ->editColumn('items', function($data){
            $items = Order::select('prodID', 'quantity')->where('transactionID', $data->transactionID)->get();
            $itemlist = '';
            foreach ($items as $value) {
              $name = Product::select('brandName', 'size')->where('prodID', $value['prodID'])->first();
              $itemlist .= "<p class='m-0'>".$name['brandName']." ".$name['size']." - ".$value['quantity']."pc(s)</p>";
            }

            return $itemlist;
          })
          ->editColumn('dOrder', function($data){
            $myFunctions = new myFunctions();
            $orderDate = $myFunctions->convernumDate($data->created_at);

            return $orderDate;
          })
          ->editColumn('dDelivered', function($data){
            if ($data->status == 4) {
              $myFunctions = new myFunctions();
              $del = $myFunctions->convernumDate($data->dateFinished);
            }else {
              $del = '';
            }
            return $del;
          })
          ->editColumn('total', function($data){
            $total = '₱'.number_format($data->total, 2, '.', ', ');
            return $total;
          })
          ->editColumn('status', function($data){
            $myFunctions = new myFunctions();
            $stat = $myFunctions->orderCStatus($data->status);

            return $stat;
          })
          ->addColumn('action', function($data){
            if ($data->status == 1 || $data->status == 2) {
              $button = '<button class="btn btn-sm btn-danger cnlOrder" id="'.$data->transactionID.'"><i class="fa fa-window-close fa-lg"></i></button>';
            }else {
              $button = '';

            }
            return $button;
          })
          ->rawColumns(['action', 'items', 'status'])
          ->make(true);
     }
      return view('orders')->with([
        'nav' => 2,
        'sjs' => 1,
        'special_js' => 'main',
        'custom_js'  => 'orders',
  ]);
  }

  public function cancelOrder(Request $request, $id){
    $tID = $id;
    $res = Transaction::select('status')->where('transactionID', $tID)->first();

    if ($res->status == 2) {
      $orders = Order::where('transactionID', $id)->get();
      foreach ($orders as $order) {
        $quantity = Product::select('quantity')->where('prodID', $order->prodID)->first();
        $new = $quantity->quantity + $order->quantity;
        $prod = Product::find($order->prodID);
        $prod->quantity = $new;
        $prod->update();
      }
    }else {
      // code...
    }

    $data = Transaction::findOrFail($tID);
    $data->status = 0;
    $data->update();

    return response()->json(['success' => ' Transaction Cancelled']);
  }
  public function saveInfo(Request $request){
    try {
          $userID = Auth::id();
          $userData = User::findOrFail($userID);
          $userData->firstName = $request->fname;
          $userData->midName = $request->mname;
          $userData->lastName = $request->lname;
          $userData->email  = $request->email;
          $userData->update();

          $userInfo = Userinfo::where('userID',$userID)->first();
          $userInfo->gender = $request->gender;
          $userInfo->mobileNum = $request->contact;
          $userInfo->birthDay = $request->bday;
          $userInfo->update();
          return response()->json(['success' => 'Personal information updated']);
    } catch (\Exception $e) {
      return response()->json(['error' => $e]);
    }
  }
  public function saveAddress(Request $request){
    try {
          $userID = Auth::id();

          $userInfo = Userinfo::where('userID',$userID)->first();
          $userInfo->buldingNum = $request->houseNum;
          $userInfo->brgy = $request->brgy;
          $userInfo->city = $request->city;
          $userInfo->province = $request->province;
          $userInfo->zip = $request->zip;
          $userInfo->update();
          return response()->json(['success' => 'Delivery address updated!']);
    } catch (\Exception $e) {
      return response()->json(['error' => $e]);
    }
  }
  public function checkPass(Request $request){
          $userID = Auth::id();
          $data = User::find($userID);
          if (Hash::check($request->pass,$data->password)) {
            return 1;
          }else{
            return 0;
          }

  }
  public function changePass(Request $request){
    try {
          $userID = Auth::id();
          $newpass = Hash::make($request->pass);

          $result = User::findOrFail($userID);
          $result->password =  $newpass;
          $result->update();

          return response()->json(['success' => 'Password updated!']);
    } catch (\Exception $e) {
      return response()->json(['error' => $e]);
    }
  }

  public function countCart(){

          $userID = Auth::id();

          try {
            $ctrItems = DB::table('carts')
                        ->select(DB::raw('count(id) as ctr'))
                        ->groupBy('userID')
                        ->first();
            return $ctrItems->ctr;
          } catch (\Exception $e) {
            return 0;
          }



  }
}
