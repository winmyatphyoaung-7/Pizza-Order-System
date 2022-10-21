<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_id',
        'name',
        'image',
        'price',
        'waiting_time',
        'description',
        'view_count'
    ];
}
