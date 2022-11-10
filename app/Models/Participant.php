<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id');
    }
}
