<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PropertyValue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $max_index =  Property::max('index');

        return view('Admin.Properties.index', compact('max_index'));
    }


    /**
     * Get a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $query = Property::where('id', '!=', 0)
            ->orderBy('id', 'desc');

        return DataTables::eloquent($query)
            ->editColumn('name', function ($property) {
                return isset($property->name) ? $property->name : '';
            })
            ->editColumn('property_values', function ($property) {
                $property_values = isset($property->propertyValues) ? $property->propertyValues->sortBy('index') : null;

                return $property_values ? $property_values->pluck('name')->implode(', ') : '';
            })
            ->editColumn('index', function ($property) {
                return '<a href="#" class="badge bg-success btn-sm propertyIndexBtn"  data-title="Change Indexing" data-id="' . $property->id . '" data-index="' . $property->index . '" style="padding: 0px 7px 1px !important;">
                    <span class="badge badge-light" style="font-size:10px; margin:0px -10px 0px -10px !important;">' . $property->index . '</span>
                </a>';
            })
            ->editColumn('status', function ($property) {
                if ($property->status == 'ACTIVE') {
                    return '<div class="form-check form-switch"><input class="form-check-input properties-status-switch" type="checkbox" checked data-routekey="' . $property->route_key . '"/></div>';
                } else {
                    return '<div class="form-check form-switch"><input class="form-check-input properties-status-switch" type="checkbox" data-routekey="' . $property->route_key . '"/></div>';
                }
            })
            ->addColumn('action', function ($property) {
                $edit  = '<a href="' . route('admin.properties.edit', ['property' => $property->route_key]) . '" class="badge bg-warning fs-1"><i class="fa fa-edit"></i></a>';
                return $edit;
            })
            ->filterColumn('index', function ($query, $keyword) {
                $query->where('index', 'like', "%{$keyword}%")
                    ->orWhere('name', 'like', "%{$keyword}%")
                    ->orWhere('status', 'like', "%{$keyword}%");
            })
            ->addIndexColumn()
            ->rawColumns(['name', 'property_values', 'index', 'status', 'action'])
            ->setRowId('id')
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Properties.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        if (!$request->names) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please add at least one property value.',
            ], 400);
        }

        $user = Auth::user();

        $data = $request->all();
        $data['index'] = Property::max('index') + 1;

        $property = Property::create($data);

        $property_values = [];

        foreach ($request->names as $key => $name) {
            $property_values[] = [
                'property_id' => $property->id,
                'name' => $name,
                'color' => $request->colors[$key] ?? null,
                'index' => $request->indexes[$key],
                'status' => $request->statuses[$key] ?? 'INACTIVE',
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        PropertyValue::insert($property_values);

        return response()->json([
            'status' => 'success',
            'message' => 'Property created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('Admin.Properties.form', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $this->validate($request, $this->rules);

        $user = Auth::user();

        $property->update($request->all());

        foreach ($request->names as $key => $name) {
            PropertyValue::updateOrCreate(
                [
                    'property_id' => $property->id,
                    'name' => $name,
                ],
                [
                    'color' => $request->colors[$key] ?? null,
                    'index' => $request->indexes[$key],
                    'status' => $request->statuses[$key] ?? 'INACTIVE',
                    'updated_by' => $user->id,
                    'updated_at' => now(),
                    'created_by' => $user->id,
                    'created_at' => now(),
                ]
            );
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Property updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $property = Property::findByKey($request->route_key);
        $property->update(['status' => $request->status]);

        return response()->json([
            'status' => 'success',
            'message' => ucfirst(strtolower($property->name)) . ' has been marked ' . ucfirst(strtolower($property->status)) . ' successfully',
        ], 200);
    }

    public function propertyValueCreate(Request $request)
    {
        if ($request->is_color) {
            $is_color = $request->is_color;
            $random_number = rand(1000, 9999);

            return view('Admin.Properties.values', compact('random_number', 'is_color'));
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Is color field is required.',
            ], 400);
        }
    }

    public function updateIndex(Request $request)
    {
        $property = Property::find($request->property_id);

        $swap_index_property = Property::where('index', $request->index)->first();

        $swap_index_property->update(['index' => $property->index]);

        $property->update(['index' => $request->index]);

        return response()->json([
            'status' => 'success',
            'message' => 'Index updated successfully.',
        ], 200);
    }

    private $rules = [
        'name' => 'required|string|max:255',
        'label' => 'nullable|string|max:255',
        'slug' => 'nullable|string|max:255',
        'is_color' => 'required|in:YES,NO',
    ];
}
