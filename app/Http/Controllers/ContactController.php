<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //user contact page

    public function contactPage() {
        return view('user.contact.contact');
    }

    //user contact

    public function contact(Request $request) {
        $this->contactValidationCheck($request);
        $data = $this->requestContactData($request);
        Contact::create($data);
        return redirect()->route('user#contactPage')->with(["sendSuccess" => "We send your message successfully..."]);
    }

    public function contactCreatePage() {
        $contactList = Contact::paginate(5);
        return view('admin.contact.adminContact',compact('contactList'));
    }

    //request Contact Data

    private function requestContactData($request) {
        return [
            'name' => $request->contactName,
            'email' => $request->contactEmail,
            'phone' => $request->contactNumber,
            'address' => $request->contactAddress,
            'message' => $request->contactMessage,
        ];
    }

    //contact validation

    private function contactValidationCheck($request) {
        Validator::make($request->all(),[
            'contactName' => 'required',
            'contactEmail' => 'required',
            'contactNumber' => 'required',
            'contactAddress' => 'required',
            'contactMessage' => 'required',
        ])->validate();
    }


}
