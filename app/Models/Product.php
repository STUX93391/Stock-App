<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $fillable=['business_id','branch_id','pr_title','sku','price','quantity'];

    /**
     * Relation of the product with the branch.
     *
     * @return void
     */
    public function prBranch(){
        return $this->belongsTo(Branch::class);
    }

    /**
     * Relation of product with the business.
     *
     * @return void
     */
    public function prBusiness(){
        return $this->belongsTo(Business::class);
    }
}
