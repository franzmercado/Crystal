<?php
namespace App\Libraries;


class myFunctions {

  public function transacID(){
    $dateToday = date('Y').date('m').date('d');
    $id = range(0,9);
    shuffle($id);
    $digits = "";
    for ($i=0; $i < 10; $i++) {
      $digits .= $id[$i];
    }
    return  $dateToday.$digits;
  }
  public function concatname($lname,$fname,$mname){
    if ($mname == null) {
      $data = $fname.' '.$lname;
    }else {
      $midInitial = substr($mname,0,1);
      $data = $fname.' '.$midInitial.'. '.$lname;
    }
    return $data;
  }
  public function makeAddress($home, $brgy, $city, $prov){
    $data = $home.', Brgy.'.$brgy.', '.$city.', '.$prov;
    return $data;
  }
  public function conLocation($brgy, $city, $prov){
    $data = 'Brgy.'.$brgy.', '.$city.', '.$prov;
    return $data;
  }
  public function getAge($bday){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($bday), date_create($today));
    $data = $diff->format('%y');
    return $data;
  }
  public function userStats($stat){
    if ($stat==1) {
      $data =  "<span><i class='fa fa-circle fa-md' style='color:green;'></i></span>";
    }else {
      $data =  "<span><i class='fa fa-ban'  style='color:red;'></i></span>";
    }
    return $data;
  }
  public function converDate($date){
    $data = date('M d, Y', strtotime(explode(" ", $date)[0]));
    return $data;
  }
  public function convertDateM($date){
    $data = date('F d, Y', strtotime(explode(" ", $date)[0]));
    return $data;
  }
  public function convernumDate($date){
    $data = date('m/d/Y', strtotime(explode(" ", $date)[0]));
    return $data;
  }
  public function orderStatus($num){
    switch ($num) {
        case 0:
          return "<span class='btn btn-secondary btn-sm w-100'>Cancelled</span>";
          break;
        case 1:
          return "<span class='btn btn-warning btn-sm w-100'>Pending</span>";
          break;
        case 2:
          return "<span class='btn btn-info btn-sm w-100'>Preparing</span>";
          break;
        case 3:
          return "<span class='btn btn-primary btn-sm w-100'>Shipping</span>";
          break;
        case 4:
          return "<span class='btn btn-success btn-sm w-100'>Delivered</span>";
          break;
        case 9:
          return "<span class='btn btn-danger btn-sm w-100'>Declined</span>";
          break;
      }
  }
  public function orderCStatus($num){
    switch ($num) {
        case 0:
          return "<span class='btn btn-secondary btn-sm w-100'>Cancelled</span>";
          break;
        case 1:
          return "<span class='btn btn-warning btn-sm w-100'>Pending</span>";
          break;
        case 2:
          return "<span class='btn btn-info btn-sm w-100'>To Ship</span>";
          break;
        case 3:
          return "<span class='btn btn-primary btn-sm w-100'>To receive</span>";
          break;
        case 4:
          return "<span class='btn btn-success btn-sm w-100'>Completed</span>";
          break;
        case 9:
          return "<span class='btn btn-danger btn-sm w-100'>Declined</span>";
          break;
      }
  }
  public function textStatus($stat){
    if($stat == 4){
      $stats = 'Delivered';
    }elseif ($stat == 3) {
      $stats = 'Shipping';
    }
    return $stats;
  }
}
