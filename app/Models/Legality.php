<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Legality extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'legality';
    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(LegalityImage::class, 'legality_id')->orderBy('sort_order');
    }
}
