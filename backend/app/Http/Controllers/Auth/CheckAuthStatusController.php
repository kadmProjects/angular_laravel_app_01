<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckAuthStatusController extends Controller {
    
    public function loginStatus(Request $request) {
        try {
            $user = Auth::user();
            if ($user) {
                $response['message'] = 'AuthenticatedUser.';
                $response['status'] =  '200';
                $response['data']['user']['id'] = $user->id;
                $response['data']['user']['name'] = $user->name;
                $response['isLoggedIn'] = true;

                return response()->json(['success' => $response]);
            } else {
                $response['message'] = 'Unauthorised access. Please login again.';
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
}
