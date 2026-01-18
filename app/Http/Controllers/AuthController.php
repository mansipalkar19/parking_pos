<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VendorMapping;
use App\Models\Master;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $authUser = $request->user();
        try {
            $request->validate([
                'name'        => 'required',
                'password'    => 'required|min:6',
                'email'       => 'nullable|email|unique:users,email',
                'mobile'      => 'nullable',
                'fk_place_id' => 'required|exists:places,id',
                'operator_status'    => 'required|in:active,inactive',
            ]);

            $status = $request->operator_status === 'active' ? 1 : 0;

            $user = User::create([
                'name'      => $request->name,
                'mobile'    => $request->mobile,
                'email'     => $request->email,
                'password'  => md5($request->password),
                'role'      => 2,
                'notes'      => $request->notes,
                'status'    => $status,
                'place_id'  => $request->fk_place_id,
                'api_token' => Str::random(60)
            ]);

            if (!$user) {
                return response()->json([
                    'ack' => 'error',
                    'message' => 'User registration failed'
                ], 500);
            }

            VendorMapping::create([
                'fk_place_id'  => $request->fk_place_id,
                'operator_id'  => $user->id,
                'status'       => $status,
                'created_by'   => $authUser->id,
                'updated_by'   => $authUser->id,
            ]);

            return response()->json([
                'ack'        => 'success',
                'message'    => 'User registered successfully',
                'token_type' => 'Bearer',
                'token'      => $user->api_token,
                'user'       => [
                    'id'         => $user->id,
                    'name'       => $user->name,
                    'mobile'     => $user->mobile,
                    'email'      => $user->email,
                    //'role'       => $user->role,
                    'status'     => $user->status ? 'active' : 'inactive', // ✅ map here
                    'place_id'   => $user->place_id,
                    'created_at' => $user->created_at->toISOString(),
                    'updated_at' => $user->updated_at->toISOString(),
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'ack' => 'error',
                'message' => collect($e->errors())->flatten()->first()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'ack' => 'error',
                'message' => $e->getMessage() // shows actual DB error
            ], 500);
        }
    }



    // LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $username = strtolower(trim($request->email));

        $user = User::whereRaw('LOWER(TRIM(email)) = ?', [$username])->first();

        if (!$user) {
            return response()->json([
                'ack' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        if ($user->accept_request != 1) {
            return response()->json([
                'ack' => 'error',
                'message' => 'User request not accepted yet'
            ], 403);
        }

        if ($user->password !== md5($request->password)) {
            return response()->json([
                'ack' => 'error',
                'message' => 'Invalid password'
            ], 401);
        }

        if (!$user->api_token) {
            $user->api_token = Str::random(60);
            $user->save();
        }

        $role = Master::where('name', $user->role)->first();

        return response()->json([
            'ack' => 'success',
            'token'  => $user->api_token,
            'user'   => [
                'id'        => $user->id,
                'name'      => $user->name,
                'mobile'    => $user->mobile,
                'email'     => $user->email,
                //'role'      => $user->role,
                'role_id'   => $role ? $role->id : null,
                ////'vendor_id' => $user->vendor_id,
                //'place_id'  => $user->place_id,
                'status'    => $user->status,
                'created_at' => $user->created_at,
                // ->timezone('Asia/Kolkata')
                // ->format('Y-m-d H:i:s'),
                'updated_at' => $user->updated_at
                // ->timezone('Asia/Kolkata')
                // ->format('Y-m-d H:i:s'),
            ]
        ]);
    }


    public function profile(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'user' => $request->user()
        ]);
    }
}
