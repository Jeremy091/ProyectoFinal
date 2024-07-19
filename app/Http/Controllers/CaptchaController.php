<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function index(){
        return view('index');
    }

    public function reloadCaptcha(){
        return reponse()->json(['captcha'=>captcha_img('math')]);
    }

    public function post(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'captcha' => 'required|captcha',
        ]);

    return "The form has been successfully submitted!";    
    }
}
