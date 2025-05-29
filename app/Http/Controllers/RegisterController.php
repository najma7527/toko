<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
   public function register (RegisterRequest $request){
        $data = $request->validated(); 
        $data['password'] = Hash::make($data['password']);
    
        User::create($data);
        
        return redirect()->back()->with('success', 'Selamat! Anda berhasil registrasi akun.');
    
        }
}
