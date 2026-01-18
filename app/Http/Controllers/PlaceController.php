<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class PlaceController extends Controller
{
    // List all places
    public function index()
    {
        return view('admin.placenames'); // your blade page
    }

    //Store new place

    public function store(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'place_name'             => 'required|max:100',
            'address'                => 'required|max:255',
            'no_of_slots'             => 'required|integer|min:1',
            'allowed_vehicle_types'   => 'required|array|min:1',
            'parking_place_status'    => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ack'     => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $status = $request->parking_place_status === 'active' ? 1 : 0;

        $exists = Place::where('place_name', $request->place_name)
            ->exists();

        if ($exists) {
            return response()->json([
                'ack'     => 'error',
                'message' => 'Place already exists',
            ], 409);
        }

        $place = Place::create([
            'place_name'   => $request->place_name,
            'address'      => $request->address,
            'no_of_slots'  => $request->no_of_slots,
            'vehicle_type' => $request->allowed_vehicle_types,
            'created_by'   => $user->id,
            'updated_by'   => $user->id,
            'status'       => $status,
        ]);

        return response()->json([
            'ack'     => 'success',
            'message' => 'Place created successfully',
            'data'    => [
                'id'                     => $place->id,
                'place_name'             => $place->place_name,
                'address'                => $place->address,
                'no_of_slots'             => $place->no_of_slots,
                'allowed_vehicle_types'   => $place->vehicle_type,
                'parking_place_status'    => $place->status ? 'active' : 'inactive',
                'created_at'              => $place->created_at->toISOString(),
                'updated_at'              => $place->updated_at->toISOString(),
            ]
        ], 201);
    }



    public function listPlacess()
    {
        return DataTables::eloquent(
            Place::where('status', 1)
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


    //Show single place
    public function show($id)
    {

        $place = Place::with(['creator', 'updater'])->find($id);

        if (!$place) {
            return response()->json([
                'status' => 'error',
                'message' => 'Place not found'
            ], 404);
        }

        return response()->json([
            'ack' => 'success',
            'data' => [
                'id'                     => $place->id,
                'place_name'             => $place->place_name,
                'address'                => $place->address,
                'no_of_slots'             => $place->no_of_slots,
                'allowed_vehicle_types'   => $place->vehicle_type,
                'parking_place_status'    => $place->status ? 'active' : 'inactive',
                // 'created_by'              => $place->created_by,
                // 'updated_by'              => $place->updated_by,
                'created_by' => optional($place->creator)->id,

                'updated_by' => optional($place->updater)->id,
                'created_at' => $place->created_at->toISOString(),
                'updated_at' => $place->updated_at->toISOString(),
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        //print_r($request);
        $user = $request->user();
        $place = Place::find($id);

        if (!$place) {
            return response()->json([
                'ack' => 'error',
                'message' => 'Place not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'place_name'   => 'required|max:100',
            'address'      => 'required|max:100',
            'no_of_slots'  => 'required|integer',
            'allowed_vehicle_types'   => 'required|array|min:1',
            'parking_place_status'    => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ack' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $status = $request->parking_place_status === 'active' ? 1 : 0;

        // Duplicate check
        $exists = Place::where('place_name', $request->place_name)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json([
                'ack' => 'error',
                'message' => 'Place already exists'
            ], 409);
        }

        $place->update([
            'place_name'   => $request->place_name,
            'address'      => $request->address,
            'no_of_slots'  => $request->no_of_slots,
            'vehicle_type' => $request->allowed_vehicle_types,
            'status'       => $status,
            'updated_by'   => $user->id,
        ]);

        return response()->json([
            'ack' => 'success',
            'message' => 'Place updated successfully',
            'data' => [
                'id'           => $place->id,
                'place_name'   => $place->place_name,
                'address'         => $place->address,
                'no_of_slots'  => $place->no_of_slots,
                'allowed_vehicle_types'   => $place->vehicle_type,
                'parking_place_status'    => $place->status ? 'active' : 'inactive',
                'updated_at'   => Carbon::parse($place->updated_at)->toISOString(),
            ]
        ], 200);
    }


    public function GetAllPlacess()
    {
        $places = Place::with(['creator', 'updater'])->get();

        if ($places->isEmpty()) {
            return response()->json([
                'ack' => 'error',
                'message' => 'No places found'
            ], 404);
        }

        return response()->json([
            'ack' => 'success',
            'data' => $places->map(function ($place) {
                return [
                    'id'                     => $place->id,
                    'place_name'             => $place->place_name,
                    'address'                => $place->address,
                    'no_of_slots'             => $place->no_of_slots,
                    'allowed_vehicle_types'   => $place->vehicle_type,
                    'parking_place_status'    => $place->status ? 'active' : 'inactive',

                    // 👇 return USER NAMES (recommended)
                    'created_by' => optional($place->creator)->name,
                    'updated_by' => optional($place->updater)->name,

                    // if you want IDs instead, use:
                    // 'created_by' => optional($place->creator)->id,
                    // 'updated_by' => optional($place->updater)->id,

                    'created_at' => optional($place->created_at)->toISOString(),
                    'updated_at' => optional($place->updated_at)->toISOString(),
                ];
            })
        ], 200);
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
}
