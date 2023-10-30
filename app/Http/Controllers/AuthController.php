<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendMailOTP;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['login', 'register', 'refresh']]);
    }

    public function login(LoginRequest $request) {
        $validator = $request->validated();

        $user = User::where('email', $validator['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'User is not existed'], 404);
        }

        if (!$user->email_verified_at) {
            return response()->json(['error' => 'Email is not verified'], 500);

        }

        if (! Hash::check($validator['password'], $user['password'], [])) {
            throw new \Exception('Password is incorrect');
        }
        
        if (! $token = auth()->attempt($validator)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'status_code' => 200,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(RegisterRequest $request) {
        $data_validated = $request->validated();
        $newUser = User::create(array_merge(
            $data_validated,
            ['password' => bcrypt($request->password)]
        ));

        // verify using link 
        event(new Registered($newUser));
        Auth::login($newUser);

        // verify using sendmail OTP background job
        // SendMailOTP::dispatch($newUser)->onQueue('register')->delay(now()->addMinute(1));

        return response()->json([
            'message' => 'Register success',
            'user' => $newUser
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = auth()->getToken();
        return $this->respondWithToken(auth()->refresh($token));
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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentUser()
    {
        $thisUser = auth()->user();
        $user = User::with('avatar')->where('users.id', $thisUser['id'])->get();
        return response()->json($user);
    }
}
