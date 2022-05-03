<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Room::all());
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
            'bldgName' => 'required|string|max:255',
            'roomName' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            $room = Room::create($request->all());
            $response = [
                'status' => 200,
                'success' => true,
                'response' => [ 'data' => $room ],
            ];
        }

        return response()->json($response, $response['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $response = [
            'status' => 403,
            'success' => false,
            'response' => '',
        ];

        $validator = Validator::make($request->all(), [
            'bldgName' => 'sometimes|string|max:255',
            'roomName' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            $room->update($request->all());
            $response = [
                'status' => 200,
                'success' => true,
                'response' => [ 'data' => $room ],
            ];
        }

        return response()->json($response, $response['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Room successfully deleted.'
        ]);
    }
}
