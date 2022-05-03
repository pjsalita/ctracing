<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = [
            'status' => 403,
            'success' => false,
            'response' => '',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            $user = User::create($request->all());
            $response = [
                'status' => 200,
                'success' => true,
                'response' => [ 'data' => $user ],
            ];
        }

        return response()->json($response, $response['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $response = [
            'status' => 403,
            'success' => false,
            'response' => '',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'purpose' => 'sometimes|string|max:255',
            'date' => 'sometimes|date_format:Y-m-d',
            'time' => 'sometimes|date_format:H:i',
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            $user->update($request->all());
            $response = [
                'status' => 200,
                'success' => true,
                'response' => [ 'data' => $user ],
            ];
        }

        return response()->json($response, $response['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'User successfully deleted.'
        ]);
    }
}
