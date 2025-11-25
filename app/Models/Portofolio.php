<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portofolio extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'portofolio';
    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(PortfolioImage::class, 'portofolio_id')->orderBy('sort_order');
    }
}
