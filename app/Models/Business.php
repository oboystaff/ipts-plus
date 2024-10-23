<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_owner_id',
        'business_name',
        'business_type',
        'business_class',
        'location',
        'email',
        'street_name',
        'digital_address',
        'house_number',
        'business_phone',
        'permit_number',
        'business_validation_code',
        'registration_number',
        'business_address',
        'business_contact',
        'nature_of_business',
        'tax_identification_number',
        'establishment_date',
        'citizen_account_number',
        'bus_account_number',
        'status_of_business',
        'assembly_code',
        'division_id',
        'block_id',
        'zone_id',
        'property_use_id',
        'created_by'
    ];

    public function customer()
    {
        return $this->belongsTo(Citizen::class, 'citizen_account_number');
    }

    public function businessClass()
    {
        return $this->belongsTo(BusinessClass::class, 'business_class');
    }

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class, 'business_type');
    }

    public function businessOwner()
    {
        return $this->hasMany(BusinessOwner::class, 'business_owner_id', 'business_owner_id');
    }

    public function assembly()
    {
        return $this->belongsTo(Assembly::class, 'assembly_code', 'assembly_code');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function propertyUse()
    {
        return $this->belongsTo(PropertyUser::class, 'property_use_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
