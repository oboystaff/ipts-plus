<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Assembly extends Model
{
    use HasFactory;

    protected $table = 'assemblies';


    protected $fillable = [
        'name',
        'assembly_code',
        'regional_code',
        'supervisor',
        'geo_reference_area',
        'logo',
        'invoice_layout',
        'status'
    ];

    public function region()
    {
        return $this->belongsTo(GhanaRegion::class, 'regional_code', 'regional_code');
    }

    public function assemblySupervisor()
    {
        return $this->belongsTo(User::class, 'supervisor');
    }

    public static function generateImageFileName()
    {
        $fileName = Str::random();
        while (self::where('logo', $fileName)->first()) {
            self::generateImageFileName();
        }

        return $fileName;
    }
}
