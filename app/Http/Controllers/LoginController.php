<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Registration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function GetData(Request $req){
        
        $req->validate([
            'Email' => 'required|email',
            'Password' => 'required'
        ],[       
            'Email.required' => 'Cannot Be Empty',
            'Email.email' => 'Invalid Email',
            'Password.required' => 'Cannot Be Empty'
            ]);
    
        $data = $req->input();
        $val  = Registration::where('Email','=',$data['Email'])->exists();
        $alldata = Registration::where('Email', '=',$data['Email'])->first();
        if($val == 0)
        {
            $req->validate([
                'Email' => 'unique:Registrations'
            ],[
                'Email.unique' => 'Invalid Email'
            ]);
            $req->session()->flash('FalseEmail','Invalid Email');
            return redirect('login');     
         }
        else
        {
            if(Hash::check($data['Password'], $alldata['Password']))
            {
                // $User_Details = Registration::where('Id', '=', $alldata['Id']);
                $req->session()->put('Login_Details',['Login_Fname' => $alldata['FirstName'],
                                                      'Login_LName' => $alldata['LastName'],
                                                       'Login_Email' => $alldata['Email'],
                                                       'Login_CollegeName' => $alldata['CollegeName'],
                                                       'Login_Phone' => $alldata['Phone'],
                                                       'Login_ID' => $alldata['Id']
                                                        ]);
                return redirect('profile');
            }
        //     else{
        //         return redirect('login');
        //     }
            
        }
        
    }

}