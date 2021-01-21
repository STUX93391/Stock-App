<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $fillable=['user_id','title','address','email','contact','type'];

    /**
     * Relation of the business with the account.
     *
     * @return void
     */
    public function account(){
        return $this->hasOne(Account::class);
    }

    /**
     * Relation of the business with the branch.
     *
     * @return void
     */
    public function branch(){
        return $this->hasMany(Branch::class);
    }

    /**
     * Relation of the business with the product.
     *
     * @return void
     */
    public function product(){
        return $this->hasMany(Product::class);
    }
    /**
     * Relation of the user with business.
     *
     * @return void
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
