<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Destination::all());
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
            'location' => 'required|string|max:255',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            $destination = Destination::create($request->all());
            $response = [
                'status' => 200,
                'success' => true,
                'response' => [ 'data' => $destination ],
            ];
        }

        return response()->json($response, $response['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        return response()->json($destination);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
    {
        $response = [
            'status' => 403,
            'success' => false,
            'response' => '',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'date' => 'sometimes|date_format:Y-m-d',
            'time' => 'sometimes|date_format:H:i',
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            $destination->update($request->all());
            $response = [
                'status' => 200,
                'success' => true,
                'response' => [ 'data' => $destination ],
            ];
        }

        return response()->json($response, $response['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Destination successfully deleted.'
        ]);
    }
}
