<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Citizen;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_type',
        'postal_address',
        'digital_address',
        'location',
        'street_name',
        'rated',
        'validated',
        'property_number',
        'ratable_value',
        'customer_name',
        'assembly_code',
        'longitude',
        'latitude',
        'division_id',
        'block_id',
        'zone_id',
        'property_use_id',
        'created_by'
    ];

    public function customer()
    {
        return $this->belongsTo(Citizen::class, 'customer_name');
    }

    public function entityType()
    {
        return $this->belongsTo(BusinessClassType::class, 'entity_type');
    }

    public function assembly()
    {
        return $this->belongsTo(Assembly::class, 'assembly_code', 'assembly_code');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function propertyUse()
    {
        return $this->belongsTo(PropertyUser::class, 'property_use_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class, 'property_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
