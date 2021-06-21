<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;
    protected $table="local";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'nif';
    public $timestamps = false;
}
