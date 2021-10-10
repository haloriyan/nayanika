<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories','title','description','task','featured_image'
    ];

    public function images() {
        return $this->hasMany('App\Models\PortfolioImage', 'portfolio_id');
    }
}
