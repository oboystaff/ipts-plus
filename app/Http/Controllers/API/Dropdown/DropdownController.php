<?php

namespace App\Http\Controllers\API\Dropdown;

use App\Http\Controllers\Controller;
use App\Models\Assembly;
use App\Models\BusinessClassType;
use App\Models\Citizen;
use App\Models\Division;
use App\Models\PropertyUser;
use App\Models\Zone;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DropdownController extends Controller
{
    public function index(Request $request)
    {
        $zones = Zone::orderBy('created_at', 'DESC')
            ->with(['propertyUse'])
            ->get(['id', 'name']);

        $divisions = Division::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get(['id', 'division_name AS name']);

        $assemblies = DB::table('assemblies')
            ->orderBy('created_at', 'DESC')
            ->select('assembly_code AS id', 'name')
            ->get();

        $citizens = Citizen::orderBy('created_at', 'DESC')
            ->get(['id', 'first_name AS name']);

        $blocks = Block::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get(['id', 'block_name AS name']);

        $entityTypes = BusinessClassType::orderBy('created_at', 'DESC')
            ->get(['id', 'name']);

        $propertyUses = PropertyUser::orderBy('created_at', 'DESC')
            ->get(['id', 'name']);

        $responseData = [
            'message' => 'Get all dropdowns',
            'zones' => $zones,
            'divisions' => $divisions,
            'assemblies' => $assemblies,
            'citizens' => $citizens,
            'blocks' => $blocks,
            'entityTypes' => $entityTypes,
            'propertyUses' => $propertyUses,
        ];

        return response()->json($responseData);
    }
}
