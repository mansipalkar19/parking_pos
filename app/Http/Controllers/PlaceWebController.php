<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use  App\Services\RoleService;

class PlaceWebController extends Controller
{
    public function index()
    {
        return view('admin.placenames'); // your blade page
    }

    public function store(Request $request)
    {
        $masterController = app(MasterController::class);
        $role = $masterController->store($request);
        if (!$role) {
            return redirect()->back()->with('error', 'Failed to create place.');
        }

        return redirect()->back()->with('success', 'Place created successfully!');
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $masterController = app(MasterController::class);
        $role = $masterController->update($request, $id);
        if (!$role) {
            return redirect()->back()->with('error', 'Failed to create place.');
        }

        return redirect()->back()->with('success', 'Place updated successfully!');
    }

    // DELETE
    public function destroy($id)
    {
        $masterController = app(MasterController::class);
        $role = $masterController->destroy($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Failed to create place.');
        }

        return redirect()->back()->with('success', 'Place deleted successfully!');
    }
}
