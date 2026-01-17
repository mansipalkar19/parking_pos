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
        $validator = Validator::make($request->all(), [
            'place_name'   => 'required|max:100',
            'city'         => 'required|max:100',
            'state'        => 'required|max:100',
            'country'      => 'required|max:100',
            'user_id'      => 'required|max:10',
            'no_of_slots'  => 'required',
            'operator_id'  => 'required',
            'vehicle_type' => 'required|array',
            'status'       => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ack' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $exists = Place::where('place_name', $request->place_name)
            ->where('city', $request->city)
            ->exists();

        if ($exists) {
            return response()->json([
                'ack' => 'error',
                'message' => 'Place already exists'
            ], 409);
        }

        $place = Place::create([
            'place_name'   => $request->place_name,
            'city'         => $request->city,
            'state'        => $request->state,
            'country'      => $request->country,
            'no_of_slots'  => $request->no_of_slots,
            'vehicle_type' => $request->vehicle_type,
            'status'       => $request->status,
            'created_by'   => $request->operator_id,
            'updated_by'   => $request->operator_id,
        ]);

        return response()->json([
            'ack' => 'success',
            'message' => 'Place created successfully',
            'data' => [
                'id'           => $place->id,
                'place_name'   => $place->place_name,
                'city'         => $place->city,
                'state'        => $place->state,
                'country'      => $place->country,
                'no_of_slots'  => $place->no_of_slots,
                'vehicle_type' => $place->vehicle_type,
                'status'       => $place->status,
                'created_at'   => Carbon::parse($place->created_at)
                    ->timezone('Asia/Kolkata')
                    ->format('d-m-Y H:i:s'),
                'updated_at'   => Carbon::parse($place->updated_at)
                    ->timezone('Asia/Kolkata')
                    ->format('d-m-Y H:i:s'),
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

    public function update(Request $request, $id)
    {
        $place = Place::find($id);

        if (!$place) {
            return response()->json([
                'ack' => 'error',
                'message' => 'Place not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'place_name'   => 'required|max:100',
            'city'         => 'required|max:100',
            'state'        => 'required|max:100',
            'country'      => 'required|max:100',
            'no_of_slots'  => 'required|integer',
            'operator_id'  => 'required',
            'vehicle_type' => 'required|array',
            'status'       => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ack' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Duplicate check
        $exists = Place::where('place_name', $request->place_name)
            ->where('city', $request->city)
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
            'city'         => $request->city,
            'state'        => $request->state,
            'country'      => $request->country,
            'no_of_slots'  => $request->no_of_slots,
            'vehicle_type' => $request->vehicle_type,
            'status'       => $request->status,
            'updated_by'   => $request->operator_id,
        ]);

        return response()->json([
            'ack' => 'success',
            'message' => 'Place updated successfully',
            'data' => [
                'id'           => $place->id,
                'place_name'   => $place->place_name,
                'city'         => $place->city,
                'state'        => $place->state,
                'country'      => $place->country,
                'no_of_slots'  => $place->no_of_slots,
                'vehicle_type' => $place->vehicle_type,
                'status'       => $place->status,
                'updated_at'   => Carbon::parse($place->updated_at)
                    ->timezone('Asia/Kolkata')
                    ->format('d-m-Y H:i:s'),
            ]
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

        $place->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Place deleted successfully'
        ]);
    }
}
