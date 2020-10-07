<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $table = "stockout";
    protected $fillable = ['name', 'detail', 'stock'];
}
