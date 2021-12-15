<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = ['CEP','id_state','id_city','street','number','neighborhoods','complements','created_at','updated_at'];

    public $timestamps = true;
}
