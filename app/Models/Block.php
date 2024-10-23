<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'blocks';

    protected $fillable = [
        'block_code',
        'block_name',
        'assembly_code',
        'division_code',
        'status'
    ];

    // Define the relationship with the Assembly model
    public function assembly()
    {
        return $this->belongsTo(Assembly::class, 'assembly_code', 'assembly_code');
    }

    // Define the relationship with the Division model
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_code');
    }
}
