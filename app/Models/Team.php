<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $dates = ['created_at', 'updated_at'];
    
    public function members()
    {
        return $this->belongsToMany(Member::class);
    }
}