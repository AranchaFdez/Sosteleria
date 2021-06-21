<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_Plato extends Model
{
    use HasFactory;
    protected $table="categoria_plato";
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $primaryKey = 'id_cat_plato';
    public $timestamps = false;
}
