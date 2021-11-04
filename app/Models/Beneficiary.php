<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'gender', 'location'
    ];

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function lang(){
        return $this->belongsTo(Language::class);
    }
}
