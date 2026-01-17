<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use  App\Services\RoleService;

class ParkingRatesWebController extends Controller
{
    public function index()
    {
        return view('admin.parkingrates'); // your blade page
    }

    public function store(Request $request, RoleService $service)
    {
        $request->validate([
            'placename' => 'required',
            'vehicletype' => 'required',
            'hourlyrate' => 'required',
            'dailyrate' => 'required',
        ]);
        // Call your API using HTTP client
        // $response = Http::post(url('/api/addRoles'), [
        //     'name' => $request->name
        // ]);
        $role = $service->createParkingRate($request->typename);

        if (!$role) {
            return redirect()->back()->with('error', 'Failed to create Parking Rates.');
        }

        return redirect()->back()->with('success', 'Parking Rates created successfully!');
    }

    public function updateparkingrates(Request $request, $id)
    {
        $response = Http::post(url("/api/updateParkingRates/$id"), [
            'typename' => $request->name
        ]);

        if ($response->failed()) {
            return response()->json(['status' => 'error'], 400);
        }

        return response()->json(['status' => 'success']);
    }

    public function destroyparkingrates($id)
    {
        $response = Http::post(url("/api/destroyParkingRates/{$id}/destroyParkingRates"));

        if ($response->failed()) {
            return response()->json(['status' => 'error'], 400);
        }

        return response()->json(['status' => 'success']);
    }
}
