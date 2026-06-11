<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{

  // Removed: protected $with = ['user'];
  // This caused circular eager loading with Seller model.
  // Use Shop::with('user') explicitly in queries where needed.

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  
  public function seller_package(){
    return $this->belongsTo(SellerPackage::class);
  }
  public function followers(){
    return $this->hasMany(FollowSeller::class);
  }
}
