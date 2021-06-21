<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    use HasFactory;
    protected $table="bebida";
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $primaryKey = 'id_bebida';
    public $timestamps = false;
}
