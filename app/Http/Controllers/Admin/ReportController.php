<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Libraries\myFunctions;
// use Illuminate\Support\Facades\Storage;
use Crabbly\Fpdf\Fpdf;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Transaction;
use App\User;
use App\Userinfo;

class PDF extends Fpdf
{
  function CreateHeader($title,$date){
      // Logo
      $this->Image(url('dist/img/crystalLogo.png'),117,8,14);

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
      $fn = new myFunctions;

      $this->Cell(70,7,'Date Printed: '.$fn->convernumDate(date('M d, yy')),0,1,'R');

      // $this->Ln(10)
  }
  function Footer()
{
    $fname = Auth::guard('admin')->user()->fname;
    $lname = Auth::guard('admin')->user()->lname;

    $this->SetY(-10);
    $this->SetFont('Arial','',10);
    $this->Cell(0,5,'Printed by: '.$fname.' '.$lname,0,1,'R');
    $this->SetFont('Arial','I',8);
    $this->Cell(0,3.5,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

class ReportController extends Controller
{

  public function getpdf($Rep){
    $info = explode('_',$Rep);
    $type = $info[0];
    $sDate = $info[1];
    $status = $info[2];

    function tableHeader($pdf,$header,$w){
      for($i=0;$i<count($header);$i++)
          $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
          $pdf->Ln();
    }


    $pdf = new PDF('L','mm',array('216','330.2'));
    $pdf->SetAutoPageBreak(1,9);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);
    $header = array('No.','Transaction Number','Customer','Location','Date ordered','Status','Amount');
    $w = array(13,45,70,100 ,30, 25,25);
    $fn = new myFunctions;


    switch ($type) {
      case 1:
            $typ = 'Daily';
            $conDate = explode('-',$sDate);
            // Header
            $pdf->CreateHeader($typ,$fn->convertDateM($sDate));
            tableHeader($pdf,$header,$w);


            if ($status == 2) {
              $data = Transaction::where('status',4)->whereDate('dateFinished',$sDate)->get();
            }else if ($status == 3) {
              $data = Transaction::where('status',3)->whereDate('updated_at',$sDate)->get();
            }elseif ($status == 1) {
              $ids = [3,4];
              $data = Transaction::whereDate('updated_at',$sDate)->whereIn('status', $ids)->get();
            }

            $ctr =0;
            $ctr =0;
            $pager =0;
            foreach($data as $row)
            {
                $ctr++;
                $pager++;
                if ($pager>28) {
                  $pager =1;
                  $pdf->AddPage();
                  $pdf->CreateHeader($typ,$sDate);
                  tableHeader($pdf,$header,$w);
                }
                $pdf->Cell($w[0],6,$ctr,'LBR',0,'C');
                $pdf->Cell($w[1],6,$row->transactionID,'LBR');
                $names = User::where('userID', $row->userID)->first();
                $name = $fn->concatname($names->lastName,$names->firstName,$names->midName);
                $pdf->Cell($w[2],6,$name,'LBR',0,'L');
                $loc = Userinfo::where('userID',$row->userID)->first();
                $location = $fn->conLocation($loc->brgy,$loc->city,$loc->province);
                $pdf->Cell($w[3],6,$location,'LBR',0,'L');
                $orderDate = $fn->converDate($row->created_at);
                $pdf->Cell($w[4],6,$orderDate,'LBR',0,'L');
                $stat = $fn->textStatus($row->status);
                $pdf->Cell($w[5],6,$stat,'LBR',0,'L');
                $pdf->Cell($w[6],6,number_format($row->total,2,'.',','),'LBR',0,'L');

                $pdf->Ln();
            }
            //Closing line
            // $pdf->Cell(array_sum($w[6]),0,'2','T');

      break;
      case 2:
            $typ = 'Weekly';

            $startDate = date('Y-m-d', strtotime($sDate));
            $endDateA = date('Y-m-d', strtotime($sDate.'+7 days'));
            $endDateB = date('Y-m-d', strtotime($sDate.'+7 days'));

            $pdf->CreateHeader($typ,$fn->convertDateM($startDate).' to '.$fn->convertDateM($endDateB));

            tableHeader($pdf,$header,$w);

            if ($status == 2) {
                $data = Transaction::where('status',4)->whereBetween('dateFinished',[$startDate,$endDateA])->get();
            }else if ($status == 3) {
                $data = Transaction::where('status',3)->whereBetween('updated_at',[$startDate,$endDateA])->get();
            }elseif ($status == 1) {
                $ids = [3,4];
                $data = Transaction::whereIn('status', $ids)->whereBetween('updated_at',[$startDate,$endDateA])->get();
            }

            $ctr =0;
            $pager =0;
            foreach($data as $row)
            {
                $ctr++;
                $pager++;
                if ($pager>28) {
                  $pager =1;
                  $pdf->AddPage();
                  $pdf->CreateHeader($typ,$sDate);
                  tableHeader($pdf,$header,$w);
                }
                $pdf->Cell($w[0],6,$ctr,'LBR',0,'C');
                $pdf->Cell($w[1],6,$row->transactionID,'LBR');
                $names = User::where('userID', $row->userID)->first();
                $name = $fn->concatname($names->lastName,$names->firstName,$names->midName);
                $pdf->Cell($w[2],6,$name,'LBR',0,'L');
                $loc = Userinfo::where('userID',$row->userID)->first();
                $location = $fn->conLocation($loc->brgy,$loc->city,$loc->province);
                $pdf->Cell($w[3],6,$location,'LBR',0,'L');
                $orderDate = $fn->converDate($row->created_at);
                $pdf->Cell($w[4],6,$orderDate,'LBR',0,'L');
                $stat = $fn->textStatus($row->status);
                $pdf->Cell($w[5],6,$stat,'LBR',0,'L');
                $pdf->Cell($w[6],6,'P'.number_format($row->total,2,'.',','),'LBR',0,'L');

                $pdf->Ln();
              }
            // Closing line
            // $pdf->Cell(array_sum($w),0,'','T');

      break;
      case 3:
            $typ = 'Monthly';
            $edate = explode('-',$sDate);
            $month = date('F', mktime(null, null, null, $edate[1]));
            $pdf->CreateHeader($typ,$month.', '.$edate[0]);

            tableHeader($pdf,$header,$w);

            if ($status == 2) {
                $data = Transaction::where('status',4)->whereYear('dateFinished',$edate[0])->whereMonth('created_at',$edate[1])->get();
            }else if ($status == 3) {
                $data = Transaction::where('status',3)->whereYear('updated_at',$sDate)->whereMonth('created_at',$edate[1])->get();
            }elseif ($status == 1) {
                $ids = [3,4];
                $data = Transaction::whereYear('updated_at',$sDate)->whereIn('status', $ids)->whereMonth('created_at',$edate[1])->get();
            }

            $ctr =0;
            $pager =0;
            foreach($data as $row)
            {
                $ctr++;
                $pager++;
                if ($pager>28) {
                  $pager =1;
                  $pdf->AddPage();
                  $pdf->CreateHeader($typ,$sDate);
                  tableHeader($pdf,$header,$w);
                }
                $pdf->Cell($w[0],6,$ctr,'LBR',0,'C');
                $pdf->Cell($w[1],6,$row->transactionID,'LBR');
                $names = User::where('userID', $row->userID)->first();
                $name = $fn->concatname($names->lastName,$names->firstName,$names->midName);
                $pdf->Cell($w[2],6,$name,'LBR',0,'L');
                $loc = Userinfo::where('userID',$row->userID)->first();
                $location = $fn->conLocation($loc->brgy,$loc->city,$loc->province);
                $pdf->Cell($w[3],6,$location,'LBR',0,'L');
                $orderDate = $fn->converDate($row->created_at);
                $pdf->Cell($w[4],6,$orderDate,'LBR',0,'L');
                $stat = $fn->textStatus($row->status);
                $pdf->Cell($w[5],6,$stat,'LBR',0,'L');
                $pdf->Cell($w[6],6,'P'.number_format($row->total,2,'.',','),'LBR',0,'L');

                $pdf->Ln();
              }
            // Closing line
            // $pdf->Cell(array_sum($w),0,'','T');

      break;
      case 4:
            $typ = 'Annual';
            $pdf->CreateHeader($typ,$sDate);
            tableHeader($pdf,$header,$w);

            if ($status == 2) {
              $data = Transaction::where('status',4)->whereYear('dateFinished',$sDate)->get();
            }else if ($status == 3) {
              $data = Transaction::where('status',3)->whereYear('updated_at',$sDate)->get();
            }elseif ($status == 1) {
              $ids = [3,4];
              $data = Transaction::whereYear('updated_at',$sDate)->whereIn('status', $ids)->get();
            }

            $ctr =0;
            $pager =0;
            foreach($data as $row)
            {
                $ctr++;
                $pager++;
                if ($pager>28) {
                  $pager =1;
                  $pdf->AddPage();
                  $pdf->CreateHeader($typ,$sDate);
                  tableHeader($pdf,$header,$w);
                }
                $pdf->Cell($w[0],6,$ctr,'LBR',0,'C');
                $pdf->Cell($w[1],6,$row->transactionID,'LBR');
                $names = User::where('userID', $row->userID)->first();
                $name = $fn->concatname($names->lastName,$names->firstName,$names->midName);
                $pdf->Cell($w[2],6,$name,'LBR',0,'L');
                $loc = Userinfo::where('userID',$row->userID)->first();
                $location = $fn->conLocation($loc->brgy,$loc->city,$loc->province);
                $pdf->Cell($w[3],6,$location,'LBR',0,'L');
                $orderDate = $fn->converDate($row->created_at);
                $pdf->Cell($w[4],6,$orderDate,'LBR',0,'L');
                $stat = $fn->textStatus($row->status);
                $pdf->Cell($w[5],6,$stat,'LBR',0,'L');
                $pdf->Cell($w[6],6,'P'.number_format($row->total,2,'.',','),'LBR',0,'L');

                $pdf->Ln();
            }
            // Closing line
            // $pdf->Cell(array_sum($w),0,'','T');


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
