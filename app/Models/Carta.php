<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carta extends Model
{
    use HasFactory;
    protected $table="carta";
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $primaryKey = 'id_carta';
    public $timestamps = false;
}
