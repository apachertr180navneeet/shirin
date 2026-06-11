<?php
namespace App\Models; 

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\App;

class AddReview extends Model
{
    protected $fillable = ['customer_name','customer_image', 'comment', 'product_id', 'published']; 
    protected $table = 'add_reviews'; 
    protected $with = ['add_reviews_translations'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $add_reviews_translations = $this->add_reviews_translations->where('lang', $lang)->first();
        return $add_reviews_translations != null ? $add_reviews_translations->$field : $this->$field;
    }

    public function add_reviews_translations()
    {
        return $this->hasMany(AddReviewTranslation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}


