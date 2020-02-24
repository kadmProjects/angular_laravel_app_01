<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use Cookie;

/**
 * LoginController is the controller for all the user authentication (login/logout) related activities.
 * 
 * @author Dilan Madhusanka (kadm0128@gmail.com)
 * @version
 * @package
 * @copyright Copyright &copy; 2020 KadmProjects
 */
class LoginController extends Controller {

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        try {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                $response['message'] = 'Validation failed. The given data was invalid.';
                $response['validationMsgs'] = $validator->messages();
                $response['status'] = '422';

                return response()->json(['error' => $response]);
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $status = $user->status;

                if ($status === 'active') {
                    $accessTokenName = 'Access Token - ' . $user->name;

                    // Create access token for the user
                    $tokenResult = $user->createToken($accessTokenName);
                    $token = $tokenResult->accessToken;
                    $dashboardPermissions = $this->getPermissions($user, 'dashboard');

                    $response['message'] = 'UserAuthenticationSuccess';
                    $response['status'] =  '200';
                    $response['isLoggedIn'] = true;
                    $response['data']['user']['id'] = $user->id;
                    $response['data']['user']['name'] = $user->name;
                    $response['data']['permissions']['dashboard'] = $dashboardPermissions;

                    // Send token in HTTP header for mobile apps and makesure to use HTTPS protocol
                    return response()
                        ->json(['success' => $response])
                        ->withCookie('access_token', $token, 1440)
                        ->withCookie(
                            Cookie::make('XSRF-TOKEN', Str::random(40), 1440, null, null, null, false)
                        );

                } elseif ($status === 'suspended') {
                    $response['message'] = 'Unauthorised access. Your account has been suspended. Please contact your administrator.';
                    $response['status'] = '401';
                    $response['isLoggedIn'] = false;

                    return response()->json(['error' => $response]);

                } elseif ($status === 'inactive') {
                    $response['message'] = 'Unauthorised access. Currently you are not an active user. Please contact your administrator.';
                    $response['status'] = '401';
                    $response['isLoggedIn'] = false;

                    return response()->json(['error' => $response]);

                } else {
                    $response['message'] = 'Unauthorised access. Your user account status is unknown. Please contact your administrator.';
                    $response['status'] = '401';
                    $response['isLoggedIn'] = false;

                    return response()->json(['error' => $response]);
                }
            } else {
                $response['message'] = 'Unauthorised access. Given credentials doesn\'t match with our records.';
                $response['status'] = '401';
                $response['isLoggedIn'] = false;

                return response()->json(['error' => $response]);
            }
        } catch (\Exception $exception) {
            report($exception);
            $response['message'] = 'Something unexpected has occured. Please try again later.';
            $response['status'] = '500';
            $response['isLoggedIn'] = false;

            return response()->json(['error' => $response]);
        }
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'email' => 'required|string|email:rfc,dns|max:255',
            'password' => 'required|string|min:8',
            'remember_me' => 'boolean'
        ]);
    }

    public function logout (Request $request) {
        try {
            // Delete access token from database
            Auth::user()->authAcessToken()->delete();
            // If you don't want to delete the token
            // $request->user()->token()->revoke();

            $cookieCSRF = Cookie::forget('XSRF-TOKEN');
            $cookieAT = Cookie::forget('access_token');
            $response['message'] = 'You have been succesfully logged out.';
            $response['status'] = '200';

            return response()->json(['success' => $response])->withCookie($cookieCSRF)->withCookie($cookieAT);
        } catch (\Exception $exception) {
            report($exception);
            $response['message'] = 'Something unexpected has occured. Please try again later.';
            $response['status'] = '500';

            return response()->json(['error' => $response]);
        }
    }
}
