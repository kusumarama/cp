<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DesignImage extends Model
{
    use HasFactory;
    
    protected $table = 'design_images';
    protected $guarded = ['id'];

    public function design()
    {
        return $this->belongsTo(Design::class, 'design_id');
    }
}
