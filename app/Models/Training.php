<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('description', 'like', '%' . $search . '%')
                         ->orWhere('place', 'like', '%' . $search . '%')
                         ->orWhere('date', 'like', '%' . $search . '%')
                         ->orWhere('created_at', 'like', '%' . $search . '%')
                         ->orWhere('updated_at', 'like', '%' . $search . '%');
        });
    }

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_categories_id', 'id');
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'training_id', 'id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'training_id', 'id');
    }

    public function materials()
    {
        return $this->belongsTo(LearningMaterial::class, 'training_id', 'id');
    }
}
