<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    public $timestamps=true;
    public $table='branches';
    protected $fillable=['business_id','br_title','address','code'];

    /**
     * Relation of the branch with the business.
     *
     * @return void
     */
    public function brBusiness(){
        return $this->belongsTo(Business::class);
    }
}
