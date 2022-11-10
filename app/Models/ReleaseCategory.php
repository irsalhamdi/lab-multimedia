<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseCategory extends Model
{
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('created_at', 'like', '%' . $search . '%');
        });
    }

    use HasFactory;
    protected $guarded = [];
}
