<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ReportController extends Controller
{

  public function getpdf(){
    $data = $this->get_data();

  }

  public function index(){

      return view('admin.reports')->with(['exJS'=>1,
        'special_js' => 'admins',
        'custom_js' => 'dashboard'
      ]);
  }
}
