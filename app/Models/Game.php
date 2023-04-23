<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = ['name', 'description', 'pathImage', 'pathImageUrl', 'url', 'state'];
}
