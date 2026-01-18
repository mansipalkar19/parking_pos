<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;
use App\Models\Place;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use App\Services\RoleService;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;



class MasterController extends Controller
{

    public function listRoles()
    {
        return DataTables::eloquent(
            Master::where('status', 0)
        )
            ->editColumn('created_at', function ($row) {
                return $row->created_at
                    ->timezone('Asia/Kolkata')
                    ->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at
                    ->timezone('Asia/Kolkata')
                    ->format('Y-m-d H:i:s');
            })
            ->make(true);
    }



    public function addRoles(Request $request, RoleService $service)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'

        ]);

        // $role = Master::create([
        //     'name' => $request->name
        // ]);
        $role = $service->createRole($request->name);

        return response()->json([
            'status' => 'success',
            'message' => 'Role created successfully',
            'role' => $role
        ]);
    }

    public function updateRoles(Request $request, $id)
    {
        $role = Master::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $request->validate([
            'name' => 'required|unique:roles,name,' . $id
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Role updated successfully',
            'role' => $role
        ]);
    }

    public function destroyRoles($id)
    {
        $role = Master::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $role->status = 1;
        $role->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully'
        ]);
    }

    //places

    public function listPlacess()
    {
        return DataTables::eloquent(
            Place::where('status', 1)
        )
            ->addColumn('vehicle_types', function ($place) {

                if (empty($place->vehicle_type)) {
                    return '-';
                }

                $ids = is_array($place->vehicle_type)
                    ? $place->vehicle_type
                    : json_decode($place->vehicle_type, true);

                return Vehicle::whereIn('id', $ids)
                    ->pluck('vehicle_type_name')
                    ->implode(', ');
            })
            ->editColumn(
                'created_at',
                fn($row) =>
                $row->created_at->timezone('Asia/Kolkata')->format('Y-m-d H:i:s')
            )
            ->editColumn(
                'updated_at',
                fn($row) =>
                $row->updated_at->timezone('Asia/Kolkata')->format('Y-m-d H:i:s')
            )
            ->make(true);
    }
    //Store new place

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'place_name' => 'required|max:100|unique:places,place_name,NULL,id,city,' . $request->city,
            'city'       => 'required|max:100',
            'state'      => 'required|max:100',
            'country'    => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ack' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $exists = Place::where('place_name', $request->place_name)
            ->where('status', '1')
            ->exists();

        if ($exists) {
            return response()->json([
                'ack' => 'error',
                'message' => 'Place already exists'
            ], 409);
        }

        $place = Place::create($request->all());

        return response()->json([
            'ack' => 'success',
            'message' => 'Place created successfully',
            'data' => [
                'id' => $place->id,
                'place_name' => $place->place_name,
                'city' => $place->city,
                'state' => $place->state,
                'country' => $place->country,
                'status' => $place->status,
                'created_at' => Carbon::parse($place->created_at)
                    ->timezone('Asia/Kolkata')
                    ->format('d-m-Y H:i:s'),
                'updated_at' => Carbon::parse($place->updated_at)
                    ->timezone('Asia/Kolkata')
                    ->format('d-m-Y H:i:s'),
            ]
        ], 201);
    }


    //Show single place
    public function show($id)
    {
        $place = Place::find($id);

        if (!$place) {
            return response()->json([
                'status' => 'error',
                'message' => 'Place not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $place
        ]);
    }

    //Update place
    public function update(Request $request, $id)
    {
        $place = Place::find($id);

        if (!$place) {
            return response()->json([
                'status' => 'error',
                'message' => 'Place not found'
            ], 404);
        }

        $request->validate([
            'place_name' => 'required|max:100',
            'city'       => 'required|max:100',
            'state'      => 'required|max:100',
            'country'    => 'required|max:100',
            'status'     => 'in:0,1'
        ]);

        $place->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Place updated successfully',
            'data' => $place
        ]);
    }

    //Delete place
    public function destroy($id)
    {
        $place = Place::find($id);

        if (!$place) {
            return response()->json([
                'status' => 'error',
                'message' => 'Place not found'
            ], 404);
        }

        $place->status = 0;
        $place->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Place deleted successfully'
        ]);
    }

    // Vehicle master
    public function listVehicletypes()
    {
        return DataTables::eloquent(
            Vehicle::where('status', 1)
        )
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->toISOString();
            })
            ->editColumn('updated_at', function ($row) {
                return Carbon::parse($row->updated_at)->toISOString();
            })
            ->toJson();
    }

    public function addVehicleTypes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_type_name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ack' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $exists = Vehicle::where('vehicle_type_name', $request->vehicle_type_name)
            ->exists();

        if ($exists) {
            return response()->json([
                'ack' => 'error',
                'message' => 'Vehicle type already exists'
            ], 409);
        }

        $vehicle = Vehicle::create([
            'vehicle_type_name' => $request->vehicle_type_name,
            'status' => 1,
        ]);

        return response()->json([
            'ack' => 'success',
            'message' => 'Vehicle type created successfully',
            'data' => [
                'id' => $vehicle->id,
                'vehicle_type_name' => $vehicle->vehicle_type_name,
                'status' => $vehicle->status,
                'created_at' => Carbon::parse($vehicle->created_at)
                    ->timezone('Asia/Kolkata')
                    ->format('d-m-Y H:i:s'),
                'updated_at' => Carbon::parse($vehicle->updated_at)
                    ->timezone('Asia/Kolkata')
                    ->format('d-m-Y H:i:s'),
            ]
        ], 201);
    }

    public function updateVehicleTypes(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle type not found'], 404);
        }

        $request->validate([
            'vehicle_type_name' => 'required|string|max:100'
        ]);

        $vehicle->update([
            'vehicle_type_name' => $request->vehicle_type_name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle Type updated successfully',
            'data' => $vehicle
        ]);
    }

    public function destroyVehicleTypes($id)
    {
        $typename = Vehicle::find($id);

        if (!$typename) {
            return response()->json(['message' => 'type_name not found'], 404);
        }

        $typename->status = 0;
        $typename->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle Type deleted successfully'
        ]);
    }

    // Parking Rates master
    public function listParkingRates()
    {
        return DataTables::eloquent(
            Master::where('status', 0)
        )
            ->editColumn('created_at', function ($row) {
                return $row->created_at
                    ->timezone('Asia/Kolkata')
                    ->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at
                    ->timezone('Asia/Kolkata')
                    ->format('Y-m-d H:i:s');
            })
            ->toJson();
    }

    public function addParkingRates(Request $request, RoleService $service)
    {
        $request->validate([
            'type_name' => 'required'

        ]);

        // $role = Master::create([
        //     'name' => $request->name
        // ]);
        $type_name = $service->createVehicle($request->type_name);

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle Type created successfully',
            'type_name' => $type_name
        ]);
    }

    public function updateParkingRates(Request $request, $id)
    {
        $typename = Master::find($id);

        if (!$typename) {
            return response()->json(['message' => 'Parking rates not found'], 404);
        }

        $request->validate([
            'type_name' => 'required' . $id
        ]);

        $typename->update([
            'parking_lot_id' => $request->type_name,
            'vehicle_type_id' => $request->type_name,
            'hourly_rate' => $request->type_name,
            'daily_rate' => $request->type_name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Parking Rates updated successfully',
            'role' => $typename
        ]);
    }

    public function destroyParkingRates($id)
    {
        $typename = Master::find($id);

        if (!$typename) {
            return response()->json(['message' => 'Parking rates not found'], 404);
        }

        $typename->status = 1;
        $typename->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Parking Rates deleted successfully'
        ]);
    }
}
