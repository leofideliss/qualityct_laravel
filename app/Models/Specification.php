<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;
    protected $table = 'specifications';
    public $timestamps = true;
    protected $fillable = ['id_client','name','min_value','id_product','id_experiment','id_uni'];
}
