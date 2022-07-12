<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = "vehicles";


    public function brand()
{
    return $this->belongsTo(Brand::class, 'brand_id');
}
}
