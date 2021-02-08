<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable=['business_id','action','description','quantity','amount'];
    public $timestamps=true;

    /**
     * Relation of transaction with busienss.
     *
     * @return void
     */
    public function transBus(){
        return $this->belongsTo(Business::class);
    }
}
