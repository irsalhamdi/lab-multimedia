<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseComment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function asistant()
    {
        return $this->belongsTo(Asistant::class, 'asistant_id', 'id');
    }
    
    public function dosen()
    {
        return $this->belongsTo(dosen::class, 'dosen_id', 'id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
