<?php

namespace App\Http\Controllers\Assembly;

use App\Http\Controllers\Controller;
use App\Http\Requests\Assembly\CreateAssemblyRequest;
use App\Http\Requests\Assembly\UpdateAssemblyRequest;
use App\Http\Requests\Import\ImportAssemblyRequest;
use App\Imports\Assembly\AssemblyImport;
use Illuminate\Http\Request;
use App\Models\Assembly;
use App\Models\GhanaRegion;
use App\Models\InvoiceLayoutTemplate;
use App\Models\Mmda;
use App\Models\User;
use Illuminate\Support\Facades\File as FileDelete;
use Illuminate\Validation\ValidationException;


class AssemblyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {
        if (!auth()->user()->can('assemblies.view')) {
            abort(403, 'Unauthorized action.');
        }

        $assemblies = Assembly::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('assembly.index', compact('assemblies'));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('assemblies.create')) {
            abort(403, 'Unauthorized action.');
        }

        $regions = GhanaRegion::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->get();

        $supervisors = User::select('id', 'name', 'phone')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->where('status', 'Active')
            ->get()
            ->map(function ($supervisor) {
                return [
                    'id' => $supervisor->id,
                    'name' => $supervisor->name . " - " . $supervisor->phone,
                ];
            });

        return view('assembly.create')->with([
            'regions' => $regions,
            'supervisors' => $supervisors
        ]);
    }

    public function store(CreateAssemblyRequest $request)
    {
        try {

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $image_name = Assembly::generateImageFileName();
                $image_name = $image_name . '.' . $image->getClientOriginalExtension();
                $logoDestinationPath = storage_path('app/public/images/logo');
                $image->move($logoDestinationPath, $image_name);
            }

            $data = $request->validated();
            $data['logo'] = $image_name ?? null;
            $data['status'] = "Active";

            Assembly::create($data);

            return redirect()->route('assembly.index')->with('status', 'Assembly created successfully.');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function edit(Request $request, Assembly $assembly)
    {
        if (!auth()->user()->can('assemblies.update')) {
            abort(403, 'Unauthorized action.');
        }

        $regions = GhanaRegion::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->get();

        $supervisors = User::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->where('status', 'Active')
            ->get()
            ->map(function ($supervisor) {
                return [
                    'id' => $supervisor->id,
                    'name' => $supervisor->name . " - " . $supervisor->phone,
                ];
            });


        return view('assembly.edit', compact('assembly', 'supervisors', 'regions'));
    }

    public function show(Assembly $assembly)
    {
        $invoiceLayoutTemplates = InvoiceLayoutTemplate::all();

        return view('assembly.show', compact('assembly', 'invoiceLayoutTemplates'));
    }

    public function update(UpdateAssemblyRequest $request, Assembly $assembly)
    {
        try {
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $image_name = Assembly::generateImageFileName();
                $image_name = $image_name . '.' . $image->getClientOriginalExtension();
                $logoDestinationPath = storage_path('app/public/images/logo');
                $image->move($logoDestinationPath, $image_name);
            }

            if ($request->hasFile('logo')) {
                $image_path = storage_path() . '/app/public/images/logo/' . $assembly->logo;
                FileDelete::delete($image_path);
            }

            $data = $request->validated();
            $data['logo'] = $image_name ?? $assembly->logo;

            $assembly->update($data);

            return redirect()->route('assembly.index')->with('status', 'Assembly updated successfully.');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    // Remove the specified assembly from the database
    public function destroy(Assembly $assembly)
    {
        $assembly->delete();

        return redirect()->route('assembly.index')
            ->with('success', 'Assembly deleted successfully.');
    }

    public function fetchAssembly(Request $request)
    {
        $region = GhanaRegion::where('regional_code', $request->regional_code)->first();

        $assemblies = Mmda::where('region_id', $region->id)->get();

        return response()->json([
            'message' => $assemblies
        ]);
    }

    public function import()
    {
        return view('assembly.import');
    }

    public function importData(ImportAssemblyRequest $request)
    {
        try {
            $data = $request->validated();
            $createdBy = $request->user()->id;

            $import = (new AssemblyImport($createdBy));
            $import->import($request->file('file'));

            return redirect()->route('assembly.index')->with('status', 'Assembly data uploaded successfully.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $exception) {
            throw ValidationException::withMessages([
                'file' => collect($exception->errors())->flatten()->toArray(),
            ]);
        }
    }
}
