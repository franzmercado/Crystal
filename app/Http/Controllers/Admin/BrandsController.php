<?php

namespace App\Http\Controllers\Admin;

use App\Brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BrandsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (request()->ajax()) {
        return datatables()->of(Brand::latest()->get())
         ->addColumn('action', function($data){
           $button = '<button class="btn btn-warning btn-sm edit" id="'.$data->brandID.'"><i class="fa fa-edit fa-md"></i></button>';
           $button .= '&nbsp;&nbsp;';
           $button .= '<button class="btn btn-danger btn-sm delete" id="'.$data->brandID.'"><i class="fa fa-trash fa-md"></i></button>';
           return $button;
         })
         ->rawColumns(['action'])
         ->make(true);
    }

      return view('admin.brands')->with(['exJS'=>1,
        'special_js' => 'admins',
        'custom_js' => 'brands'
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = array('description' => 'required|unique:brands|max:16');
      $error = Validator::make($request->all(), $rules);
      if ($error->fails()) {
        return response()->json(['errors' => $error->errors()->all()]);
      }

      $formData = array('description' => $request->description);
      Brand::create($formData);
      return response()->json(['success' => 'New brand name has been added. ']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (request()->ajax()) {
        $brands = Brand::findOrFail($id);
        return response()->json(['brand' => $brands]);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $rules = array('descriptions' => 'required|unique:brands,description|max:16');
      $error = Validator::make($request->all(), $rules);

      if ($error->fails()) {
        return response()->json(['errors' => $error->errors()->all()]);
      }
      $formData = array('description' => $request->descriptions);

       $data = Brand::findOrFail($id);
       $data->update($formData);
       return response()->json(['success' => 'Brand name has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Brand::findOrFail($id);
      $data->delete();
      return response()->json(['success' => 'Brand name has been deleted. ']);
    }
}
