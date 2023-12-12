<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $table = 'products';

    use HasFactory;

    protected $fillable = ['article', 'name', 'path', 'discription', 'category_id', 'price'];

    public function categorys()
    {
        return $this->belongsTo('App\Categories');
    }

    // Фильтр по тегам и поисковая строка
    public function scopeFilter($query, array $filters)
    {
        if ($filters['category'] ?? false)
        {
            $query->where('category', 'like', '%' . request('category') . '%');
        }

        if ($filters['search'] ?? false)
        {
            $query->where('name', 'like', '%' . request('search') . '%');
        }
    }
}
