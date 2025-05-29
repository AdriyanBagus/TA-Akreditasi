<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menuAdmin extends Model
{
   protected $table = 'menuAdmin';

    protected $fillable = [
        'menu',
        'link',
    ];
}
