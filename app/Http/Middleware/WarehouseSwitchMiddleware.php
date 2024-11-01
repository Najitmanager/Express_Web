<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Cargo\Entities\Branch;

class WarehouseSwitchMiddleware
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
        if (!auth()->user()->branches()->count()){
            auth()->logout();
            return redirect()->route('login')->with(['error_message_alert'=>'You do not have permission to access this page.']);

        }
        if (is_null(session('warehouse'))){

            session(['warehouse'=>Branch::find(auth()->user()->id)]);
            $branch=session('warehouse');
        }else{
            $branch=session('warehouse');
        }
        app('hook')->set('warehouse',$branch,'object');
        return $next($request);
    }
}
