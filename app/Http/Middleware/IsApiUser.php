<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsApiUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $access_token = $request->access_token ;
        // This is another alternamtive  
        // if ($request->has('access_token')) {
        if($access_token != null && $access_token != '') {
            // Now Check to see if there is a user with thus token  ; 
            $user = User::where('access_token', $access_token)->first();
            if($user != null) {
                return $next($request);
            }
            else {
                return response()->json(['error' => 'Not Authorized']);
            }
        }
        else {
            return response()->json(['error' => 'Invalid access token']);
        }
        // return $next($request);

    }
}
