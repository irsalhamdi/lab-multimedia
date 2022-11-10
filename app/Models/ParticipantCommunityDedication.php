<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantCommunityDedication extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }

    public function dedication()
    {
        return $this->belongsTo(CommunityDedication::class, 'dedication_id', 'id');
    }
}
