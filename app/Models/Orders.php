<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public $table = 'orders';

    use HasFactory;

    protected $fillable = ['name', 'phon', 'email', 'product_id'];
}
