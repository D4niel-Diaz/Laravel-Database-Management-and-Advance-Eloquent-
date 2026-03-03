<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'city',
        'state',
        'zip_code',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}