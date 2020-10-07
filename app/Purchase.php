<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';

    protected $fillable = ['name', 'stock', 'supplier'];
}
