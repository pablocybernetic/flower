<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abouts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'features',
        'image1',
        'image2',
        'image3',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
