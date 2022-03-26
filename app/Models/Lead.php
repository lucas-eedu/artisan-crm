<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
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
    protected $table = 'leads';
 
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
        'user_id',
        'company_id',
        'product_id',
        'origin_id',
        'name',
        'email',
        'phone',
        'message',
        'status'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }
}
