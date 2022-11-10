<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function regency()
    {
        return $this->belongsTo(Province::class, 'regency_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(Province::class, 'district_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Province::class, 'village_id', 'id');
    }
}
