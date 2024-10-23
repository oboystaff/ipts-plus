<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions';


    protected $fillable = [
        'division_code',
        'division_name',
        'assembly_code',
        'status',
    ];

    // Define the relationship with the Assembly model
    public function assembly()
    {
        return $this->belongsTo(Assembly::class, 'assembly_code', 'assembly_code');
    }

    // Define the relationship with the Block model
    public function blocks()
    {
        return $this->hasMany(Block::class, 'division_code', 'division_code');
    }
}
