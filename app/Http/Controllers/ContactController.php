<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax() || request()->route()->getPrefix() === 'api') {
            return response()->json(Contact::all());
        }

        $contacts = Contact::paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
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
                $contact = Contact::create($request->all());
                $response = [
                    'status' => 200,
                    'success' => true,
                    'response' => [ 'data' => $contact ],
                ];
            }

            return response()->json($response, $response['status']);
        }

        $validated = $request->validate($rules);
        Contact::create($validated);

        return redirect()->route('contact.index')->with('success', 'Successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return response()->json($contact);
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $rules = [
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'purpose' => 'sometimes|string|max:255',
            'date' => 'sometimes|date_format:Y-m-d',
            'time' => 'sometimes|date_format:H:i',
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
                $contact->update($request->all());
                $response = [
                    'status' => 200,
                    'success' => true,
                    'response' => [ 'data' => $contact ],
                ];
            }

            return response()->json($response, $response['status']);
        }

        $validated = $request->validate($rules);
        $contact->update($validated);

        return back()->with('success', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        if (request()->ajax() || request()->route()->getPrefix() === 'api') {
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Contact successfully deleted.'
            ]);
        }

        return redirect()->route('contact.index')->with('success', 'Successfully deleted.');
    }
}
