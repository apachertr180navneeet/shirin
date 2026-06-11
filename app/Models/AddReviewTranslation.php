<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

class AddReviewTranslation extends Model
{
    protected $fillable = ['add_review_id', 'lang','customer_name','customer_image', 'comment', 'published'];

    public function add_review()
    {
        return $this->belongsTo(AddReview::class);
    }
}
