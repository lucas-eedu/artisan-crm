<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
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
    protected $table = 'permissions';
 
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
        'name',
        'code'
    ];

    public function profiles() {
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }

}
