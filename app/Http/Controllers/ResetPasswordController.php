<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;
use App\User;
use DB;

class ResetPasswordController extends Controller
{
    public function sendEmail(Request $request)
    {
    	$email = $this->validateEmail($request);
    	return response()->json($email);
    }

    public function validateEmail(Request $request)
    {
    	$validation_messages = [
    		'email.required' => 'El email de recuperacion es requerido',
    		'email.email' => 'El email no es una direccion de correo valida',
    		'email.exists' => 'El email no esta registrado en el sistema',
    	];

    	$email = $request->validate([
		    		'email' => 'required|email|exists:users,email']
		    		, $validation_messages
		    	);

    	$this->sendResetPasswordEmail($email['email']);

    	return response()->json([
    		'message' => 'Correo de recuperacion enviado!, por favor revisa tu correo'
    	]);

    }

    public function createToken($email)
    {
        $tokenExists = DB::table('password_resets')->where('email',$email)->first();

        if ($tokenExists)
            return $tokenExists->token;

        $token = Str::random(60);

        $this->saveToken($token, $email);

        return $token;

    }

    public function saveToken($token, $email)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }

    public function sendResetPasswordEmail($email)
    {
        $to_name = User::where('email',$email)->first()->name;
        $token = $this->createToken($email);
        $data = [
            'token' => $token,
            'email' => $email
        ];  

        Mail::send("=mails.resetPassword", $data, function($message) use ($email, $to_name){

            $message->to($email, $to_name)
                    ->subject('Recuperacion de contraseña SGM');

        });
    }
}
