<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'about';
    protected $guarded = ['id'];
    protected $fillable = ['title', 'title_id', 'subtitle', 'subtitle_id', 'image'];
}
