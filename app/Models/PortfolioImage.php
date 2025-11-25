<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioImage extends Model
{
    use HasFactory;
    
    protected $table = 'portfolio_images';
    protected $guarded = ['id'];

    public function portfolio()
    {
        return $this->belongsTo(Portofolio::class, 'portofolio_id');
    }
}
