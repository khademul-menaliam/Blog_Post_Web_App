<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

protected $table = 'posts';
    protected $fillable = [
        'title',
        'img',
        'slug',
        'description',
        'category_id',
        'views',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * Relationship: Post belongs to Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
