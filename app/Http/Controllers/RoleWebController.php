<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use  App\Services\RoleService;

class RoleWebController extends Controller
{
    public function index()
    {
        return view('admin.userroles'); // your blade page
    }

    public function store(Request $request, RoleService $service)
    {
        $request->validate([
            'name' => 'required'
        ]);
        // Call your API using HTTP client
        // $response = Http::post(url('/api/addRoles'), [
        //     'name' => $request->name
        // ]);
        $role = $service->createRole($request->name);

        if (!$role) {
            return redirect()->back()->with('error', 'Failed to create role.');
        }

        return redirect()->back()->with('success', 'Role created successfully!');
    }

    public function update(Request $request, $id)
    {
        $masterController = app(MasterController::class);

        return $masterController->updateRoles($request, $id);
    }

    public function destroy($id)
    {
        $masterController = app(MasterController::class);

        return $masterController->destroyRoles($id);
    }
}
