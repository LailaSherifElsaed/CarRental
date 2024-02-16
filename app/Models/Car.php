<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'categoryId',
        'title',
        'luggage',
        'doors',
        'passenger',
        'description',
        'price', 
        'active',
        'image',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class,'categoryId');
    }
}
