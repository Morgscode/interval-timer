<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Exception;

class CheckUserAgainstToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {

            if ( (int) $request->user  !== request()->user()->id ) {
                throw new Exception("forbidden - you cannot access/modify those resources", 401);
            }

            return $next($request);

        } catch (Exception $e) {

            return response()->json([
                'status' => 'not-authorized',
                'message' => $e->getMessage(),
                'staus_code' => $e->getCode(),
            ]);
        }
       
    }
}
