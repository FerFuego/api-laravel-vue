<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Category extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'code',
        'name',
        'description'
    ];

    /**
     * Relationships
     */
    public function products() {
        return $this->belongsToMany(Product::class, 'products_categories');
    }
}
