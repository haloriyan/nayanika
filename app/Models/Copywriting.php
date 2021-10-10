<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copywriting extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code','body'
    ];
}
