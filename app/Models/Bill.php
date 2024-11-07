<?php

namespace App\Models;

use App\Models\Assembly;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bills_id',
        'property_id',
        'business_id',
        'assembly_code',
        'bills_year',
        'arrears',
        'amount',
        'billing_date',
        'created_by',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function assembly()
    {
        return $this->belongsTo(Assembly::class, 'assembly_code', 'assembly_code');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'bills_id', 'bills_id');
    }
}
