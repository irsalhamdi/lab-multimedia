<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('email', 'like', '%' . $search . '%');
        });
    }
}
