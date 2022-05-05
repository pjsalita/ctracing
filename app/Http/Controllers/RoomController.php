<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax() || request()->route()->getPrefix() === 'api') {
            return response()->json(Room::all());
        }

        $rooms = Room::paginate(10);
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
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
            'bldgName' => 'required|string|max:255',
            'roomName' => 'required|string|max:255',
        ];

        if ($request->ajax() || $request->route()->getPrefix() === 'api') {
            $response = [
                'status' => 403,
                'success' => false,
                'response' => '',
            ];

            $validator = Validator::make($request->all(), $rules);

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

        $validated = $request->validate($rules);
        Room::create($validated);

        return redirect()->route('room.index')->with('success', 'Successfully added.');
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

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
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
        $rules = [
            'bldgName' => 'sometimes|string|max:255',
            'roomName' => 'sometimes|string|max:255',
        ];

        if ($request->ajax() || $request->route()->getPrefix() === 'api') {
            $response = [
                'status' => 403,
                'success' => false,
                'response' => '',
            ];

            $validator = Validator::make($request->all(), $rules);

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

        $validated = $request->validate($rules);
        $room->update($validated);

        return back()->with('success', 'Successfully updated.');
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

        if (request()->ajax() || request()->route()->getPrefix() === 'api') {
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Room successfully deleted.'
            ]);
        }

        return redirect()->route('room.index')->with('success', 'Successfully deleted.');
    }
}
