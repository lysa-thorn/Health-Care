<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Material extends Model
{
    use HasFactory;
    /**
     * Get the user that owns the material.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
