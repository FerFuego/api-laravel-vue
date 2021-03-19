<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Product extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'code',
        'name',
        'description',
        'photo'
    ];

    /**
     * Relationships
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'products_categories');
    }

    public function rates() {
        return $this->HasMany(Rate::class);
    }
}
