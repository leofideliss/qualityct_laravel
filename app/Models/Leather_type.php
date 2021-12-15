<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leather_type extends Model
{
    use HasFactory;
    protected $table = 'leather_types';
    public $timestamps = false;
    protected $fillable = ['name'];
}
