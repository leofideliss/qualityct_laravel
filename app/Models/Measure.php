<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    use HasFactory;

    protected $table = 'measures';

    public $timestamps = false;

    protected $fillable = ['uni'];

}
