<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $fillable=['business_id','bank','acc_title','type','number','balance','jointAcc','terms'];

    /**
     * Relation of the account with the business.
     *
     * @return void
     */
    public function accBusiness(){
        return $this->belongsTo(Business::class);
    }
}
