<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['company_name','CNPJ','contact_name','phone','email','id_address','created_at','updated_at'];

    public $timestamps = true;

    public function products(){
       return $this->hasMany(Products::class);
    }
}
