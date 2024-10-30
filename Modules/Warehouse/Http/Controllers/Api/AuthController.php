<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Warehouse\Http\Requests\Api\LoginRequest;
use Modules\Warehouse\Transformers\Api\Auth\UserResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/login",
     *     summary="login",
     *     tags={"Auth"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function login(LoginRequest $request)
    {
        if (!$token = auth('api')->attempt($request->validated())) {
            return response()->json(['status' => 'fail', 'data' => null, 'message' => trans('api.auth.failed')],401);
        }

        $user = auth('api')->user();
        data_set($user,'token' , $token);
        return (new UserResource($user))->additional(['status' => 'success','message'=>'']);
    }
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['status' => 'success','data' => null,'message' => 'Successfully logged out']);
    }
    // Refresh a token
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    // Helper function to format the response with token
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    // Send an OTP code to the user's email
    public function sendResetOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['status' => 'fail', 'data' => null,'message' => 'User not found'], 404);
        }

        // Generate OTP
        $otp = rand(1000, 9999);
        $expiresAt = Carbon::now()->addMinutes(10); // OTP valid for 10 minutes

        // Store OTP and expiration in the database
        DB::table('password_resets_otp')->updateOrInsert(
            ['email' => $request->email],
            ['otp' => $otp, 'expires_at' => $expiresAt]
        );

        // Send OTP to the user's email
        Mail::to($request->email)->send(new \App\Mail\SendOtpMail($otp));

        return response()->json(['status' => 'success', 'data' => null,'message' => 'OTP sent to your email']);
    }

    // Verify OTP and reset password
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:4',
        ]);

        // Check OTP and expiration
        $record = DB::table('password_resets_otp')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$record) {
            return response()->json(['status' => 'fail', 'data' => null,'message' => 'Invalid or expired OTP'], 400);
        }

        // Update user password
        $user = User::where('email', $request->email)->first();
        $token=JWTAuth::fromUser($user);
        data_set($user,'token' , $token);
        return (new UserResource($user))->additional(['status' => 'success','message'=>'']);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = auth()->user();

        $user->update(['password'=> Hash::make($request->password)]);
        // Delete the OTP record after successful password reset
        DB::table('password_resets_otp')->where('email', $request->email)->delete();
        return (new UserResource($user))->additional(['status' => 'success','message'=>'Password has been reset successfully']);
    }

}
