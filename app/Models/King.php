<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class King extends Model
{
    use HasFactory;
    protected $table = 'King';
    protected $fillable = ['adi', 'sucipto'];
    
}