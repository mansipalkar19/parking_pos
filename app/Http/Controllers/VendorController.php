<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Vendor;
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
}
