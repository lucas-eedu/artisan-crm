<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory, Uuid;

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
    protected $table = 'profiles';
 
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
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class)->withTimestamps();;
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
