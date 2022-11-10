<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('description', 'like', '%' . $search . '%')
                         ->orWhere('created_at', 'like', '%' . $search . '%');
        });
    }

    public function category()
    {
        return $this->belongsTo(ReleaseCategory::class, 'release_categories_id', 'id');
    }
}
