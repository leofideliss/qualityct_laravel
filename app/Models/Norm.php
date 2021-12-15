<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Norm extends Model
{
    use HasFactory;
    protected $table = 'norms';
    public $timestamps = true;
    protected $fillable = ['name','min_value','id_segment','id_leather_type','id_experiment','id_uni'];
}
