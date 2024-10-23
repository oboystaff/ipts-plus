<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'other_name',
        'gender',
        'date_of_birth',
        'marital_status',
        'nia_number',
        'account_number',
        'telephone_number',
        'country_of_citizenship',
        'customer_type',
        'status',
        'Ghana_card_number',
        'created_by',
        'email',
        'password',
        'accesstype',
        'user_id'
    ];

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
