<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('description', 'like', '%' . $search . '%')
                         ->orWhere('created_at', 'like', '%' . $search . '%')
                         ->orWhere('updated_at', 'like', '%' . $search . '%');
        });
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_categories_id', 'id');
    }
}
