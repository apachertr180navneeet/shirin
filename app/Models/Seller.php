<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{

  // Removed: protected $with = ['user', 'user.shop'];
  // This caused circular eager loading: Seller → User → Shop → User → ...
  // Use Seller::with(['user', 'user.shop']) explicitly in queries where needed.

  public function user(){
  	return $this->belongsTo(User::class);
  }

  public function payments(){
  	return $this->hasMany(Payment::class);
  }

  public function seller_package(){
    return $this->belongsTo(SellerPackage::class);
}
}
