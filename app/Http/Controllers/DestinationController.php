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
        if (request()->ajax()) {
            return response()->json(Destination::all());
        }

        $destinations = Destination::paginate(10);
        return view('destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('destinations.create');
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
            'location' => 'required|string|max:255',
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
                $destination = Destination::create($request->all());
                $response = [
                    'status' => 200,
                    'success' => true,
                    'response' => [ 'data' => $destination ],
                ];
            }

            return response()->json($response, $response['status']);
        }

        $validated = $request->validate($rules);
        Destination::create($validated);

        return redirect()->route('destination.index')->with('success', 'Successfully added.');
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

    public function edit(Destination $destination)
    {
        return view('destinations.edit', compact('destination'));
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
        $rules = [
            'name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
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
                $destination->update($request->all());
                $response = [
                    'status' => 200,
                    'success' => true,
                    'response' => [ 'data' => $destination ],
                ];
            }

            return response()->json($response, $response['status']);
        }

        $validated = $request->validate($rules);
        $destination->update($validated);

        return back()->with('success', 'Successfully updated.');
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
        if (request()->ajax()) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Destination successfully deleted.'
            ]);
        }

        return redirect()->route('destination.index')->with('success', 'Successfully deleted.');
    }
}
