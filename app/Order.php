<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table = 'orders';
  public $primaryKey = 'orderID';
  public $incrementing = false;
  public $timestamps = false;
  protected $fillable = ['transactionID','prodID','quantity'];
}
