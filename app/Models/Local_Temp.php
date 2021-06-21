<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local_Temp extends Model
{
    use HasFactory;
    protected $table="local_temp";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'nif';
    public $timestamps = false;
}
