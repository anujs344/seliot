<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function check(Request $req)
    {
        $req->validate([
            'First_Name' => 'required|regex:/^[\pL\s\-]+$/u|min:3',
            'Last_Name' => 'required|regex:/^[\pL\s\-]+$/u|min:3',
            'Email' => 'required|email',
            'Phone' => 'required|digits:10',
            'Message' => 'required'
        ],[
            'First_Name.required' => 'Required', 'First_Name.regex' => 'Only String',
            'Last_Name.required' => 'Required', 'Last_Name.regex' => 'Only String',
            'Email.required' => 'Required' , 'Email.email' => 'Enter Valid Email',
            'Phone.required' => 'Required' , 'Phone.digits' => 'Must Contain Digits',
            'Message.required' => 'Required'
        ]);
    }
}
