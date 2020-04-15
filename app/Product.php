<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $primaryKey = 'prodID';
    public $incrementing = false;
    protected $fillable = ['prodID','thumbnail','brandName', 'size','categoryID',
     'description', 'price', 'quantity','sold'];
}
