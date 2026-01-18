<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Vendor;
use App\Models\User;
use App\Models\VendorMapping;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class VendorController extends Controller
{
    public function pending()
    {
        $query = Vendor::query()
            ->leftJoin('places', 'places.id', '=', 'users.place_id')
            ->where('users.accept_request', 0)
            ->where('users.status', 1)
            ->where('users.role', 'vendor')
            ->select([
                'users.id',
                'users.name',
                'users.mobile',
                'users.email',
                'places.place_name'
            ]);

        return DataTables::eloquent($query)
            ->setRowId('id')
            ->make(true);
    }

    public function approved()
    {
        $query = Vendor::query()
            ->leftJoin('places', 'places.id', '=', 'users.place_id')
            ->where('users.accept_request', 1)
            ->where('users.status', 1)
            ->where('users.role', 'vendor')
            ->select([
                'users.id',
                'users.name',
                'users.mobile',
                'users.email',
                'places.place_name'
            ]);

        return DataTables::eloquent($query)
            ->setRowId('id')
            ->make(true);
    }

    public function rejected()
    {
        $query = Vendor::query()
            ->leftJoin('places', 'places.id', '=', 'users.place_id')
            ->where('users.accept_request', 2)
            ->where('users.status', 1)
            ->where('users.role', 'vendor')
            ->select([
                'users.id',
                'users.name',
                'users.mobile',
                'users.email',
                'places.place_name'
            ]);

        return DataTables::eloquent($query)
            ->setRowId('id')
            ->make(true);
    }

    public function approve(Request $request, $id)
    {
        $place = Vendor::find($id);

        $place->accept_request = 1;
        $place->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Place deleted successfully'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Place updated successfully',
            'data' => $place
        ]);
    }

    //Delete place
    public function reject($id)
    {
        $place = Vendor::find($id);

        $place->accept_request = 2;
        $place->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Place deleted successfully'
        ]);
    }

    public function GetAllVendors()
    {
        $vendors = Vendor::with('place')->where('role', 'vendor')->get();

        if ($vendors->isEmpty()) {
            return response()->json([
                'ack' => 'error',
                'message' => 'No vendors found'
            ], 404);
        }

        return response()->json([
            'ack' => 'success',
            'data' => $vendors->map(function ($vendor) {

                $statusText = $vendor->status ? 'active' : 'inactive';

                if ($vendor->accept_request == 0) {
                    $msg = 'Not assigned to any parking place';
                    $placename = '';
                } else {
                    $msg = 'Assigned to place ' . $vendor->place->place_name;
                    $placename = $vendor->place->place_name;
                }

                return [
                    'id'             => $vendor->id,
                    'name'           => $vendor->name,
                    'email'          => $vendor->email,
                    'status'         => $statusText,
                    'accept_request' => $vendor->accept_request,
                    'msg'            => $msg,
                    'created_at'     => optional($vendor->created_at)->toISOString(),
                    'updated_at'     => optional($vendor->updated_at)->toISOString(),
                ];
            })
        ], 200);
    }

    public function updateOperator(Request $request, $id)
    {
        $authUser = $request->user();

        try {
            $request->validate([
                'mobile'           => 'nullable',
                'operator_status'  => 'required|in:active,inactive',
                'fk_place_id'      => 'required|exists:places,id',
            ]);

            $status = $request->operator_status === 'active' ? 1 : 0;

            $user = User::where('id', $id)
                ->where('role', 2)
                ->first();

            if (!$user) {
                return response()->json([
                    'ack' => 'error',
                    'message' => 'Operator not found'
                ], 404);
            }

            $user->update([
                'mobile'   => $request->mobile ?? $user->mobile,
                'status'   => $status,
                'place_id' => $request->fk_place_id,
            ]);

            VendorMapping::where('operator_id', $user->id)
                ->where('status', 1)
                ->update([
                    'status'     => 0,
                    'updated_by' => $authUser->id,
                ]);

            VendorMapping::create([
                'fk_place_id' => $request->fk_place_id,
                'operator_id' => $user->id,
                'status'      => 1,
                'created_by'  => $authUser->id,
                'updated_by'  => $authUser->id,
            ]);

            return response()->json([
                'ack'     => 'success',
                'message' => 'Operator updated successfully',
                'user'    => [
                    'id'       => $user->id,
                    'name'     => $user->name,
                    'mobile'   => $user->mobile,
                    'email'    => $user->email,
                    'status'   => $user->status ? 'active' : 'inactive',
                    'place_id' => $user->place_id,
                    'updated_at' => $user->updated_at->toISOString(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'ack' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
