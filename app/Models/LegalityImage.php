<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LegalityImage extends Model
{
    use HasFactory;
    protected $table = 'legality_images';
    protected $guarded = ['id'];

    public function legality()
    {
        return $this->belongsTo(Legality::class, 'legality_id');
    }
}
