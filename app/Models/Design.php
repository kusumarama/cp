<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Design extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'design';
    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(DesignImage::class, 'design_id')->orderBy('sort_order');
    }
}
