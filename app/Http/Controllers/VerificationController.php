<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    public function resendEmail(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(["message" => "sent email verification"]);
    }

    public function verifyEmail(Request $request, string $id, string $hash) {
        $user = User::find($id);
        if ($user->hasVerifiedEmail()) {
            return response()->json(["message" => "User is verified"], 200);
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        return response()->json(["message" => "verified ok"], 200);
    }
}
