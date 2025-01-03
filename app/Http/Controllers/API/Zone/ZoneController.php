<?php

namespace App\Http\Controllers\API\Zone;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $data = Zone::orderBy('created_at', 'DESC')
            ->get();

        return response()->json([
            'message' => 'Get all zones',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $zone = Zone::where('id', $id)->first();

        if (empty($zone)) {
            return response()->json([
                'message' => 'Zone not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular zone',
            'data' => $zone
        ]);
    }
}
