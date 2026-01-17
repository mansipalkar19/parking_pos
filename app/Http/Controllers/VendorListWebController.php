<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use  App\Services\RoleService;


class VendorListWebController extends Controller
{
    public function index()
    {
        return view('admin.vendorlist');
    }

    public function approve(Request $request, $id)
    {
        $masterController = app(VendorController::class);
        $role = $masterController->approve($request, $id);
        if (!$role) {
            return redirect()->back()->with('error', 'Failed to create place.');
        }

        return redirect()->back()->with('success', 'Place updated successfully!');
    }

    public function reject($id)
    {
        $masterController = app(VendorController::class);
        $role = $masterController->reject($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Failed to create place.');
        }

        return redirect()->back()->with('success', 'Place deleted successfully!');
    }
}
