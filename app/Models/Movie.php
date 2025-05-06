<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;

    protected $guarded = [];

    /**
     * Relasi ke tabel Category (Movie belongs to Category).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
