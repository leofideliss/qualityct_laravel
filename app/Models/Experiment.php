<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    use HasFactory;
    protected $table = 'experiments';
    public $timestamps = true;
    protected $fillable = ['name','id_leather_type'];
}
