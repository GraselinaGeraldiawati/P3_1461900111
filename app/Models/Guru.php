<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    public $timestamps = false;
    protected $table = 'guru';
    protected $fillable = ['id','nama','mengajar'];
}