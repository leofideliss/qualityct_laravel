<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $table = 'samples';

    protected $fillable = ['op_number','measure','date_col','obs','id_client','id_product','status'];
    
    public $timestamps = true;

}
