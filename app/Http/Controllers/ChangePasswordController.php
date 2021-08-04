<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePassword\ChangePasswordRequest;
use App\User;
use DB;

class ChangePasswordController extends Controller
{
    public function process(ChangePasswordRequest $request)
    {

        $this->changePassword($request);
        $this->removePasswordResetRegister($request);

    	return response()->json([
    		'success' => true,
    		'message' => 'Contraseña actualizada!, Inicie sesion con nueva contraseña'
    	]);
    }

    public function changePassword($request)
    {
        $user = User::whereEmail($request->email)->first();
        $user->update(['password' => $request->password]);

    }

    public function removePasswordResetRegister($request)
    {
        DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->resetToken
        ])->delete();

    }

}
