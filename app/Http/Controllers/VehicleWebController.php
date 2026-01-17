<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use  App\Services\RoleService;

class VehicleWebController extends Controller
{
    public function index()
    {
        return view('admin.vehicletypes'); // your blade page
    }

    public function add(Request $request, RoleService $service)
    {
        // DEBUG (temporary)
        // dd($request->all());

        $request->validate([
            'vehicle_type_name' => 'required'
        ]);

        $response = $service->createVehicle($request->vehicle_type_name);

        if (!$response) {
            return redirect()->back()->with('error', 'Failed to create vehicle type.');
        }

        return redirect()->back()->with('success', 'Vehicle Type created successfully!');
    }



    public function update(Request $request, $id)
    {
        $masterController = app(MasterController::class);
        $role = $masterController->updateVehicleTypes($request, $id);
        if (!$role) {
            return redirect()->back()->with('error', 'Failed to create place.');
        }

        return redirect()->back()->with('success', 'Place updated successfully!');
    }

    public function destroy($id)
    {
        $masterController = app(MasterController::class);
        $role = $masterController->destroyVehicleTypes($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Failed to create place.');
        }

        return redirect()->back()->with('success', 'Place deleted successfully!');
    }
}
