<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneratedPasswordMail;


class AuthController extends Controller
{   

    public function register(RegisterRequest $request)
    {   

        if (Auth::check())
        {  
            $user = Auth::user();

             switch($user->role_id)
             {
                case('1'):

                    $usercreate = User::create($request->validated());

                    return response($usercreate . 'case(1)');

                break;

                case('2'):
                        if($request->role_id == 3 || $request->role_id == 4 || $request->role_id == 5)
                        {
                            $usercreate = User::create($request->validated());

                            return response($usercreate . 'case(2)');
                        }

                        else
                        {
                            return response('Unauthorized Role');
                        }
                break;

                case('3'):
                        if($request->role_id == 4 || $request->role_id == 5)
                        {

                            $usercreate = User::create($request->validated());
                            
                            return response($usercreate);
                        }

                        else
                        {
                            return response('Unauthorized Role');
                        }
                break;

                case('4'):

                        return response('Unauthorized Role');
                break;

                case('5'):

                        return response('Unauthorized Role');
                break;
 
                 default:
                     $msg = 'Something went wrong.';
             }
        }

        else
        {
            return response('Unauthorized' . ' ' . 'Auth required');
        }
    }

    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }


    public function logout(Request $request, User $user)
    {
            $user->tokens()->delete();
            $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Successfully logged out'
        ]);
    }

}
