<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_Bebida extends Model
{
    use HasFactory;
    protected $table="categoria_bebida";
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $primaryKey = 'id_cat_bebida';
    public $timestamps = false;
}
