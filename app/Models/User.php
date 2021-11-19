<?php

namespace App\Models;

use App\Traits\Uuid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuid;

    /**
     * uuidName
     *
     * @var string
     */
    protected $uuidName = 'id';
    
    /**
     * table
     *
     * @var string
     */
    protected $table = 'users';
 
    /**
     * keyType
     *
     * @var string
     */
    protected $keyType = 'string';
      
    /**
     * incrementing
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_id',
        'company_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile() {
        return $this->belongsTo(Profile::class);
    }

    public function containsPermission($permissionCode) {
        if ($this->profile_id) {
            return $this->profile->permissions->pluck('code')->contains($permissionCode);
        } else {
            return false;
        }
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
