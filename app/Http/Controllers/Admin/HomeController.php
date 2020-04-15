<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Product;
use App\Transaction;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Only Authenticated users for "admin" guard
     * are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $ctr = array();
      $result = User::where('isActive', 1)->get();
      $ctr['users'] = $result->count();

      $result1 = Product::where('deleted_at', null)->get();
      $ctr['products'] = $result1->count();

      $result2 = Transaction::where('status', 1)->get();
      $ctr['orders'] = $result2->count();

      $val = $ctr;
        return view('admin.index')->with(['exJS'=>1,
          'val' => $val,
          'special_js' => 'admins',
          'custom_js' => 'dashboard'
        ]);
    }

    public function profile() {
        return view('admin.profile')->with([
        'special_js' =>'admins'
    ]);
    }
}
