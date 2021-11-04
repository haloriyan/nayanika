<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','count'
    ];

    public function services() {
        return $this->hasMany('App\Models\Service', 'category_id')->orderBy('updated_at', 'DESC');
    }
}
