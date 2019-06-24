<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::all();

        if ($request->ajax()) {
            return response()->json($contacts);
        }

        return view('contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result['message'] = 'error creating contact';
        $data = $request->contact;
        $contact = new Contact;
        $contact->firstname = $data['firstname'];
        $contact->lastname = $data['lastname'];
        $contact->numbers = json_encode($data['numbers']);

        if ($contact->save()) {
            $result['message'] = 'contact successfully created';
        }

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return response()->json($contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $result['message'] = 'error updating contact';
        $data = $request->contact;
        $contact->firstname = $data['firstname'];
        $contact->lastname = $data['lastname'];
        $contact->numbers = json_encode($data['numbers']);

        if ($contact->save()) {
            $result['message'] = 'contact successfully updated';
        }

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $result['message'] = 'error deleting contact';
        if ($contact->delete()) {
            $result['message'] = 'contact deleted';
        }
        return response()->json($result);
    }
}
