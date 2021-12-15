<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $table = 'tests';
    public $timestamps = false;
    protected $fillable = ['op_number','id_experiment','status','date_finish','result','specification','approved'];
}
