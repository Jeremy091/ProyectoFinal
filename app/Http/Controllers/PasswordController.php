<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset;

class PasswordController extends Controller
{
    public function showRecoverForm()
    {
        return view('auth.recover');
    }

    public function recover(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'security_answer' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->security_answer, $user->security_answer)) {
            return back()->withErrors(['message' => 'Información incorrecta']);
        }

        $password = Str::random(10);
        $user->password = Hash::make($password);
        $user->save();

        Mail::to($user->email)->send(new PasswordReset($password));

        return redirect()->route('login')->with('status', 'Se ha enviado una nueva contraseña a tu correo');
    }
}