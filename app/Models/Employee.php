<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $fillable=['name','business_id','branch_id','email','password','designation'];

    /**
     * Relation of employ with business
     *
     * @return void
     */
    public function empBus(){
        return $this->belongsTo(Business::class);
    }
}
