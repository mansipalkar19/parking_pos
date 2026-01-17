<?php

namespace App\Services;

use App\Models\Master;
use App\Models\Place;
use App\Models\Vehicle;

class RoleService
{
    public function createRole($name)
    {
        try {
            $role = Master::create(['name' => $name]);

            return [
                'success' => true,
                'data' => $role
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function createPlace($name)
    {
        try {
            $role = Place::create(['name' => $name]);

            return [
                'success' => true,
                'data' => $role
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function createVehicle($vehicle_type_name)
    {
        try {
            $role = Vehicle::create(['vehicle_type_name' => $vehicle_type_name, 'status' => 1]);

            return [
                'success' => true,
                'data' => $role
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function createParkingRate($type_name)
    {
        try {
            $role = Master::create(['type_name' => $type_name]);

            return [
                'success' => true,
                'data' => $role
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
