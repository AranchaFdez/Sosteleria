<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    use HasFactory;
    protected $table="plato";
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $primaryKey = 'id_plato';
    public $timestamps = false;
}
