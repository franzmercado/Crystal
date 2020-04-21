<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Userinfo;
use App\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\myFunctions;


class UsersController extends Controller
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

  public function index()
  {

    if (request()->ajax()) {

      $users = User::select(['userID', 'firstName', 'midName', 'lastName', 'email', 'isActive','created_at'])->get();


      return datatables()->of($users)
       ->editColumn('name', function($data){
          $myFunctions = new myFunctions();
          $name = $myFunctions->concatname($data->lastName,$data->firstName,$data->midName);
          return $name;
       })
       ->editColumn('age', function($data){
         $getID = $data->userID;

          $userinfo = Userinfo::select('birthDay')->where('userID', $getID)->first();
          $myFunctions = new myFunctions();
          $age = $myFunctions->getAge($userinfo->birthDay);
          return $age;
       })
       ->editColumn('status', function($data){
         $myFunctions = new myFunctions();
         $stat = $myFunctions->userStats($data->isActive);
         return $stat;
       })
       ->editColumn('dateJoined', function($data){
         $myFunctions = new myFunctions();
         $joined = $myFunctions->converDate($data->created_at);
         return $joined;
       })
       ->rawColumns(['status'])
       ->make(true);
  }

      return view('admin.usersControl')->with([
      'exJS'=>1,
      'special_js' =>'admins',
      'custom_js' => 'users'

  ]);
  }
  public function show($id)
  {
    if (request()->ajax()) {
      $user = array();
      $user['info'] = User::findOrFail($id);
      return response()->json(['user' => $user]);
    }
  }
  public function activate(Request $request, $id)
  {

  $data = User::findOrFail($id);
  $data->isActive = 1;
  $data->save();
   return response()->json(['success' => 'Account activated.']);
  }
  public function deactivate(Request $request, $id)
  {

    $check = Transaction::where([['userID',$id],['status','>',1],['status','<',4]])->get();
    $ctr = $check->count();

    if ($ctr > 0) {
      return response()->json(['error' => 'This account has an active transaction.']);

    }else {
      $data = User::findOrFail($id);
      $data->isActive = 0;
      $data->save();
       return response()->json(['success' => 'Account deactivated.']);
    }
  }
}
