<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from', 'to', 'sms', 'transaction_id','beneficiary_id'
    ];

    public function beneficiary(){
        return $this->belongsTo(Beneficiary::class,'beneficiary_id','id');
    }
}
