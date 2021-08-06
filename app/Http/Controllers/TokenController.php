<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller {
    public function gerarToken(Request $request)
    {

        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);

        $user = User::where('email', $request->email)->first();

        if (is_null($user) || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'user not logged in '
            ], 401);
        }

        $token = JWT::encode(['email' => $request->email], env('JWT_KEY'));

        return [
            'access_token' => $token
        ];
    }
}
