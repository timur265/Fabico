<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Contact;

class ContactController extends Controller
{
    public function index(){
        $contact = Contact::all()->last();
        return view('admin.pages.contacts.edit', [
            'contact' => $contact,
        ]);
    }

    //
    public function edit(Request $request){
        $this->validate($request, [
            'address' => 'required'
        ]);
        $req = $request->all();
        Contact::where('id', 1)->update(['address' => $req['address'], 'email' => $req['email'], 'number' => $req['number'], 'time' => $req['time']]);
        return redirect()->route('contact');
    }
}
