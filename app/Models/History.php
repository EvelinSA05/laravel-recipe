<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'namaakun',
        'kategori',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/public/posts/' . $image),
        );
    }
}
