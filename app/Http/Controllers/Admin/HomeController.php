<?php

namespace App\Http\Controllers\Admin;
 use Auth;
 use Validator;
 use Hash;
use App\User;
use App\Admin;
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

      $result3 = Product::where([['quantity','<=',15],['deleted_at', null]])->get();
      $ctr['low'] = $result3->count();

      $val = $ctr;
        return view('admin.index')->with(['exJS'=>1,
          'val' => $val,
          'special_js' => 'admins',
          'custom_js' => 'dashboard'
        ]);
    }

    public function getSales(){
      if (request()->ajax()) {
        $data = array();
        for ($i=0; $i < date('m') ; $i++) {
          $mon = $i+1;
          $result = Transaction::whereYear('dateFinished', '=',date('Y'))
                      ->whereMonth('dateFinished', '=',$mon)
                      ->where('status', 4)->get();
          $data['sales'][] = $result->sum('total');
        }

        $pop = Product::where('deleted_at', null)
                ->orderBy('sold', 'DESC')->limit(3)->get();
        foreach ($pop as $key => $value) {
          $data['names'][]= $value->brandName;
          $data['score'][]= $value->sold;

        }

        return $data;
      }
    }

    public function profile() {

      if (request()->ajax()) {
      $userID = Auth::id();
      $details = Admin::where('id',$userID)->first();
      return $details;
     }
        return view('admin.profile')->with([
        'exJS' => 1,
        'special_js' =>'admins',
        'custom_js' =>'profile'

    ]);
    }

    public function saveInfo(Request $request){
    try {

      $userID = Auth::id();

      $rules = array(
        'email' => 'required|max:30|unique:admins,email,'.$userID,
         'fname' => 'required|max:30',
         'lname' => 'required|max:30'

      );
      $error = Validator::make($request->all(), $rules);

      if ($error->fails()) {
        return response()->json(['errors' => $error->errors()->all()]);
      }
          $userData = Admin::findOrFail($userID);
          $userData->fname = $request->fname;
          $userData->lname = $request->lname;
          $userData->email  = $request->email;
          $userData->update();

          return response()->json(['success' => 'Personal information updated']);
    } catch (\Exception $e) {
      return response()->json(['error' => $e]);
    }
  }
          public function checkPass(Request $request){
              $userID = Auth::id();
              $data = Admin::find($userID);
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

              $result = Admin::findOrFail($userID);
              $result->password =  $newpass;
              $result->update();

              return response()->json(['success' => 'Password updated!']);
        } catch (\Exception $e) {
          return response()->json(['error' => $e]);
        }
      }
}
