<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $table = 'products';

    use HasFactory;

    protected $fillable = ['article', 'name', 'discription', 'category', 'price'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['category'] ?? false)
        {
            $query->where('category', 'like', '%' . request('category') . '%');
        }
    }
}
