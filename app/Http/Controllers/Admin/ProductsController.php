<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use App\Transaction;
use App\Order;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\myFunctions;
use Validator;

class ProductsController extends Controller
{
  public function index(){
    if (request()->ajax()) {
        $products = Product::select(['prodID', 'thumbnail','brandName', 'size', 'categoryID', 'description', 'quantity','price'])->whereNull('deleted_at')->get();
    return datatables()->of($products)
          ->editColumn('brandName', function($data){
            $brand = $data->brandName.' - '.$data->size;
            return $brand;
          })
          ->editColumn('category', function($data){
            $brand = Category::find($data->categoryID);
            return $brand->description;
          })
          ->editColumn('price', function($data){
            $price = $data->price;
            return $price;
          })
          ->addColumn('action', function($data){
            $button = '<button class="btn btn-sm btn-warning edtBtn" id="'.$data->prodID.'"><i class="fa fa-edit fa-md"></i></button>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<button class="btn btn-sm btn-danger  delBtn" id="'.$data->prodID.'"><i class="fa fa-trash fa-md"></i></button>';
            return $button;
          })
          ->rawColumns(['action'])
          ->make(true);
     }
     $category = Category::orderBy('description','ASC')->get();
    return view('admin.manageProducts')->with(['exJS'=>1,
      'category' => $category,
      'special_js' => 'admins',
      'custom_js' => 'products'
    ]);

  }
  public function addProduct(){
    $category = Category::orderBy('description','ASC')->get();

     return view('admin.addProduct')->with(['exJS'=>1,
        'category' => $category,
       'special_js' => 'admins',
       'custom_js' => 'products'
     ]);
  }
  public function store(Request $request){
    $rules = array(
      'Thumbnail'   => 'required|image|max:2048',
      'Productname' => 'required|unique_with:products,Productname = brandName,Size = size|max:30',
      'Category'    => 'required',
      'Size'        => 'required',
      'Price'       => 'required',
      'Qty'         => 'required',
      'Description' => 'required|max:400'
    );

    $error = Validator::make($request->all(), $rules);
    if ($error->fails()) {
      return response()->json(['errors' => $error->errors()->all()]);
    }

    $image = $request->file('Thumbnail');
    $newImg = rand().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('productImg'), $newImg);

    $formData = array(
      'prodID'      =>  uniqid(),
      'thumbnail'   => $newImg,
      'brandName'   => ucwords(strtolower($request->Productname)),
      'size'        => $request->Size,
      'categoryID'  => $request->Category,
      'quantity'    => $request->Qty,
      'price'       => $request->Price,
      'description' => $request->Description
    );
    Product::create($formData);
    return response()->json(['success' => 'New product has been added. ']);
  }
  public function destroy($id)
  {
    $ctr =0;

    $orders = Order::where('prodID',$id)->get();
    $ordercount = $orders->count();


    if ($ordercount > 0 ) {
      foreach ($orders as $value) {
        $trans = Transaction::where([['transactionID', $value->transactionID],['status','>',1],['status','<',4]])->get();
        $transcount = $trans->count();
        if ($transcount > 0) {
          $ctr++;
        }
      }
      if ($ctr > 0) {
        return response()->json(['error' => 'This product belongs to an active transaction!']);
      }else {
        $data = Product::findOrFail($id);
        $data->delete();
        return response()->json(['success' => 'Product has been deleted. ']);
      }
    }else{
      $data = Product::findOrFail($id);
      $data->delete();
      return response()->json(['success' => 'Product has been deleted. ']);
    }

  }
  public function restock(){
    if (request()->ajax()) {
        $products = Product::select(['prodID', 'thumbnail','brandName', 'size', 'categoryID', 'description', 'quantity'])->orderBy('quantity','ASC')->get();
    return datatables()->of($products)
          ->editColumn('brandName', function($data){
            $brand = $data->brandName.' - '.$data->size;
            return $brand;
          })
          ->editColumn('category', function($data){
            $brand = Category::find($data->categoryID);
            return $brand->description;
          })
          ->editColumn('quantity', function($data){
            $price = $data->quantity;
            return $price;
          })
          ->addColumn('action', function($data){
            $button = '<button class="btn btn-sm btn-info restk" id="'.$data->prodID.'"><i class="fa fa-plus fa-md"></i></button>';
            return $button;
          })
          ->rawColumns(['action'])
          ->make(true);
     }
     $category = Category::orderBy('description','ASC')->get();
    return view('admin.restock')->with(['exJS'=>1,
      'category' => $category,
      'special_js' => 'admins',
      'custom_js' => 'products'
    ]);

  }
  public function restockProduct(Request $request, $id){

    $data = Product::findOrFail($id);
    $data->quantity = $data->quantity + $request->quantity;
    $data->update();

    return response()->json(['success' => 'Stocks added!']);
  }
  public function updateProduct(Request $request, $id){

    $rules = array(
      'Productname' => 'required|max:30',
      'Category'    => 'required',
      'Size'        => 'required',
      'Price'       => 'required',
      'Description' => 'required|max:400'
    );

    $error = Validator::make($request->all(), $rules);
    if ($error->fails()) {
      return response()->json(['errors' => $error->errors()->all()]);
    }

    $data = Product::findOrFail($id);
    $data->brandName = ucwords(strtolower($request->Productname));
    $data->categoryID = $request->Category;
    $data->size = $request->Size;
    $data->price = $request->Price;
    $data->description = $request->Description;
    $data->update();

    return response()->json(['success' => ' Product Updated!']);
  }
  public function selProduct($id){

    $data = Product::findOrFail($id);
    return response()->json(['success' => $data]);
  }
}
