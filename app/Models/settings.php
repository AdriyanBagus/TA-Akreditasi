<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;

    protected $table = 'form_settings';
    protected $fillable = ['form_name', 'status'];
}
