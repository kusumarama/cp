<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IsoCertification extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'iso_certifications';
    protected $guarded = ['id'];
    protected $fillable = ['title', 'title_id', 'description', 'description_id', 'image', 'order'];
}
