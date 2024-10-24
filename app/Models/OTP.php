<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    protected $fillable = ['citizen_id', 'code'];
    protected $table = 'otps';

    public function citizen()
    {
        return $this->belongsTo(Citizen::class, 'citizen_id');
    }
}
