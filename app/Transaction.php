<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $table = 'transactions';
  public $primaryKey = 'transactionID';
  public $incrementing = false;
  protected $fillable = ['transactionID','userID','status', 'total','dateFinished'];
}
