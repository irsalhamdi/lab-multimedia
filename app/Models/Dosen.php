<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('email', 'like', '%' . $search . '%')
                         ->orWhere('nip', 'like', '%' . $search . '%')
                         ->orWhere('jurusan', 'like', '%' . $search . '%')
                         ->orWhere('phone', 'like', '%' . $search . '%')
                         ->orWhere('address', 'like', '%' . $search . '%')
                         ->orWhere('updated_at', 'like', '%' . $search . '%');
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'dosen';
    protected $fillable = [
        'name',
        'email',
        'profile',
        'nip',
        'jurusan',
        'phone',
        'address',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
