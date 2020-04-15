<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
  protected $table = 'userinfo';
  public $primaryKey = 'id';
  protected $fillable = ['userID','mobileNum','birthDay', 'buldingNum','brgy', 'city', 'province', 'zip'];
}
