<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Libraries\myFunctions;
// use Illuminate\Support\Facades\Storage;
use Crabbly\Fpdf\Fpdf;

use App\Http\Controllers\Controller;
use DB;

class ReportController extends Controller
{

  public function getpdf($Rep){
    $info = explode('_',$Rep);

    $type = $info[0];
    $sDate = $info[1];
    $status = $info[2];

    $pdf = new Fpdf;
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
    $pdf->Output();
    exit;
  }

  public function index(){

      return view('admin.reports')->with(['exJS'=>1,
        'special_js' => 'admins',
        'custom_js' => 'reports'
      ]);
  }
}
