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
        if (request()->ajax()) {
            return response()->json(User::all());
        }

        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
        ];

        if ($request->ajax()) {
            $response = [
                'status' => 403,
                'success' => false,
                'response' => '',
            ];

            $validator = Validator::make($request->all(), $rules);

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

        $validated = $request->validate($rules);
        User::create($validated);

        return redirect()->route('user.index')->with('success', 'Successfully added.');
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

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
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
        $rules = [
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'purpose' => 'sometimes|string|max:255',
            'date' => 'sometimes|date_format:Y-m-d',
            'time' => 'sometimes|date_format:H:i',
        ];

        if ($request->ajax()) {
            $response = [
                'status' => 403,
                'success' => false,
                'response' => '',
            ];

            $validator = Validator::make($request->all(), $rules);

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

        $validated = $request->validate($rules);
        $user->update($validated);

        return back()->with('success', 'Successfully updated.');
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
        if (request()->ajax()) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'User successfully deleted.'
            ]);
        }

        return redirect()->route('user.index')->with('success', 'Successfully deleted.');
    }
}
