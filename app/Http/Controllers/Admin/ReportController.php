<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Libraries\myFunctions;
// use Illuminate\Support\Facades\Storage;
use Crabbly\Fpdf\Fpdf;

use App\Http\Controllers\Controller;
use DB;
use App\Transaction;
class PDF extends Fpdf
{
  function CreateHeader($title,$date){
      // Logo
      // $this->Image({{asset('dist/img/flag/1.jpg')}},10,6,30);
      $this->setY(10);
      $this->SetFont('Arial','B',15);
      $this->Cell(120);
      $this->Cell(70,7,'Crystal Corporation',0,1,'L');
      $this->Cell(120);
      $this->SetFont('Arial','',8);
      $this->Cell(70,3,'#19 blk.24 Brgy. Juan Luna, Taguig City',0,1,'L');
      $this->SetFont('Arial','B',12);
      $this->Cell(240,7,$title.' Transaction Report: '.$date,0,0,'L');
      $this->SetFont('Arial','',10);
      $this->Cell(70,7,'Date Printed: '.date('M d, yy'),0,1,'R');

      // $this->Ln(10)
  }
  function Footer()
{
    $this->SetY(-5);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,3,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

class ReportController extends Controller
{

  public function getpdf($Rep){
    $info = explode('_',$Rep);
    $type = $info[0];
    $sDate = $info[1];
    $status = $info[2];

    $pdf = new PDF('L','mm',array('216','330.2'));
    $pdf->SetAutoPageBreak(1,5);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);
    $header = array('No.','Transaction Number','Customer','Location','Date ordered','Status','Amount');
    $w = array(12,45,80,70 ,40, 33,30);

    switch ($type) {
      case 1:
            $typ = 'Daily';
            // Header
            $pdf->CreateHeader($typ,$sDate);
            for($i=0;$i<count($header);$i++)
                $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
                $pdf->Ln();

            if ($status == 2) {
              $data = Transaction::where('status',4)->get();

              $ctr =0;
              foreach($data as $row)
              {
                  echo $row->transa;

                  $ctr++;
                  $pdf->Cell($w[0],6,$ctr,'LBR',0,'C');
                  $pdf->Cell($w[1],6,$row->transactionID,'LBR');
                  $pdf->Cell($w[2],6,'s','LR',0,'R');
                  $pdf->Cell($w[3],6,'s','LR',0,'R');
                  $pdf->Cell($w[4],6,'s','LR',0,'R');
                  $pdf->Cell($w[5],6,'s','LR',0,'R');
                  $pdf->Cell($w[6],6,'s','LR',0,'R');

                  $pdf->Ln();
              }
              // Closing line
              // $pdf->Cell(array_sum($w),0,'','T');

            }else if ($status == 3) {
              $stats = 3;
            }


      break;
      case 2:
            $typ = 'Weekly';

      break;
      case 3:
            $typ = 'Monthly';

      break;
      case 4:
            $typ = 'Annual';

      break;
      default:
        // code...
        break;
    }

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
