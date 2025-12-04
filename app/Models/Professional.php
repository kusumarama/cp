<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $fillable = ['name', 'position', 'category', 'details', 'photo', 'order'];
    
    const CATEGORY_BOARD = 'board_of_director';
    const CATEGORY_MANAGEMENT = 'management';
    
    const POSITIONS_BOARD = [
        'President Commissioner',
        'Commissioner',
        'President Director',
        'Director',
    ];
    
    const POSITIONS_MANAGEMENT = [
        'General Manager',
        'Manager',
        'Supervisor',
        'Staff',
    ];
}
