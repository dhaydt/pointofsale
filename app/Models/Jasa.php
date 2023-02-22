<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'price', 'description', 'category_id'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
