<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ChangePasswordController extends Controller
{
    

    public function update(Request $request) {  

        $request->validate([
            'password' => 'required|confirmed'
          
        ]);

        $record = User::find(Auth::user()->id);
        $record->update([ 			
        'password' => bcrypt($request->get('password'))        
        ]);


      
        return redirect()->route('dash')->with("success","Password changed successfully!");
    }


}
