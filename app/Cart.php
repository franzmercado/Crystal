<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $table = 'carts';
  public $primaryKey = 'id';
  protected $fillable = ['userID','prodID','quantity'];
}
