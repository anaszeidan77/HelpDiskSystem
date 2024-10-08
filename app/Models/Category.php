<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $fillable = [
        'name',
        'code',
    ];
    use HasFactory;
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
