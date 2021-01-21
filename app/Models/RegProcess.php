<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegProcess extends Model
{
    use HasFactory;
    protected $fillable=['user_id','stage'];
    public $timestamps=true;
    public $table='regProcesses';
}
