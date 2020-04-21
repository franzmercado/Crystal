<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    protected $table = 'products';
    public $primaryKey = 'prodID';
    public $incrementing = false;
    use SoftDeletes;
    protected $fillable = ['prodID','thumbnail','brandName', 'size','categoryID',
     'description', 'price', 'quantity','sold'];
}
