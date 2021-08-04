<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\User;
use App\Models\Role;

use DB;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
    	$credentials = request(['email', 'password']);
    	$credentials['is_active'] = 1;

    	try {
    		if (! $token = auth()->attempt($credentials)) {
    			return response()->json(['error' => 'Credenciales invalidas'], 401);
    		}

    	} catch (JWTException $e) {
    		return response()->json(['error' => 'No se ha podido generar un token de sesion'], 500);
    	}
           
        return $this->respondWithToken($token);
    }

    /**
     * registrar nuevo usuario.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
    	$user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'name' => $request->get('first_name').' '.$request->get('last_name'),
    		'email' => $request->get('email'),
    		'password' => $request->get('password'),
            'is_active'=>1
    	]);


        $admin_role = Role::where('name','admin')->first();
        $super_admin_role = Role::where('name','super admin')->first();


        $user->roles()->attach([$admin_role->id, $super_admin_role->id]);

        $credentials = request(['email', 'password']);
        $credentials['is_active'] = 1;

        $token = auth()->attempt($credentials);

        return $this->respondWithToken($token);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $auth_user = auth()->user();
        
        $auth_user->withRelationships();

    	return response()->json($auth_user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {

            auth()->logout();
            return response()->json(['message' => 'Session cerrada!']);

        } catch(JWTException $e)
        {
            return response()->json([
                'message' => 'Error al cerrar session, intente nuevamente',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }

    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
    	return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
    	return response()->json([
    		'access_token' => $token,
    		'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
    		'user' => $this->me()
    	]);
    }
    
}
