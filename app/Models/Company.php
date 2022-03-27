<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
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
    protected $table = 'companies';
 
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
        'segment',
        'state',
        'number_employees',
        'status'
    ];

    public function users() 
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function origins()
    {
        return $this->hasMany(Origin::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
