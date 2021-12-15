<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = ['description', 'color', 'article', 'thickness', 'id_client', 'id_segment', 'id_leather_type','created_at','updated_at'];
}
