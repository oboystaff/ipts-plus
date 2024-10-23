<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bills_id',
        'payment_mode',
        'network',
        'phone',
        'transaction_status',
        'transaction_id',
        'amount',
        'prompt',
        'assembly_code',
        'created_by',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bills_id', 'bills_id');
    }

    public function assembly()
    {
        return $this->belongsTo(Assembly::class, 'assembly_code', 'assembly_code');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
