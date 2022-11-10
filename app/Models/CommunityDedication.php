<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityDedication extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('description', 'like', '%' . $search . '%')
                         ->orWhere('date', 'like', '%' . $search . '%')
                         ->orWhere('place', 'like', '%' . $search . '%')
                         ->orWhere('created_at', 'like', '%' . $search . '%')
                         ->orWhere('updated_at', 'like', '%' . $search . '%');
        });
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
}
