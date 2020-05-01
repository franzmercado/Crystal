<?php

namespace App\Http\Controllers;
use App\Libraries\myFunctions;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      if (request()->ajax()) {
        $products = array();
        $products['latest'] = Product::where('deleted_at', null)->orderBy('created_at','desc')->take(8)->get();
        $products['popular'] = Product::where('deleted_at', null)->orderBy('sold','desc')->take(4)->get();
        $products['category'] = Category::where('deleted_at', null)->orderBy('description','asc')->get();

        return $products;
      }

        return view('welcome')->with([
        'nav' => 1,
        'special_js' => 'main',
        'custom_js'  => 'home'
        ]);
    }
    public function showAll()
    {
      $products = Product::where('deleted_at', null)->orderBy('created_at','desc')->paginate(12);

        return view('Showall')->with([
          'nav' => 1,
          'special_js' => 'main',
          'data' => $products,
          'custom_js'  => 'home'
        ]);
    }
    public function showProduct($catid,$id)
    {
        $category = Category::findOrFail($catid);
        $product = Product::findOrFail($id);

        $title['catID'] = $category->id;
        $title['catDesc'] = $category->description;
        $title['prodName'] = $product->brandName;

        return view('show')->with([
          'nav' => 1,
          'special_js' => 'main',
          'title' => $title,
          'product' => $product
        ]);
    }
    public function showCategory($id){

      $products = Product::where('deleted_at', null)->where('categoryID', $id)->orderBy('created_at','desc')->paginate(12);

      $category = Category::findOrFail($id);
      $title['catDesc'] = $category->description;
      $title['catID'] = $category->id;


      return view('FilterCategory')->with([
      'nav' => 1,
      'special_js' => 'main',
      'data' => $products,
      'title' => $title,
      'custom_js'  => 'filter'
      ]);

    }
    public function searchProduct(Request $request){
      $inp = Input::get('query');

      $results = Product::where([['deleted_at', null],['brandName','LIKE','%'.$inp.'%']])->orderBy('created_at','desc')->paginate(12);

      return view('searchResult')->with([
      'nav' => 1,
      'inp' => $inp,
      'results' => $results,
      'special_js' => 'main',
      'custom_js'  => 'home'
      ]);
    }
    public function checkLog(){
      if(Auth::check()){
        return 1;
      }else{
        return 0;
      }
    }
}
