<?php

namespace App\Http\Controllers\API\PropertyUse;

use App\Http\Controllers\Controller;
use App\Models\PropertyUser;
use Illuminate\Http\Request;


class PropertyUseController extends Controller
{
    public function index($zone_id)
    {
        $data = PropertyUser::orderBy('created_at', 'DESC')
            ->with(['zone'])
            ->where('zone_id', $zone_id)
            ->get();

        return response()->json([
            'message' => 'Get all property use',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $propertyUse = PropertyUser::where('id', $id)
            ->with(['zone'])
            ->first();

        if (empty($propertyUse)) {
            return response()->json([
                'message' => 'Property use not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particalar property use',
            'data' => $propertyUse
        ]);
    }
}