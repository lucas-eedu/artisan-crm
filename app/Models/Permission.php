<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function profiles() {
        // TODO: Explica isso melhor ae bob
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }

}
