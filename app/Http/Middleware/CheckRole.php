<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
       
      if($request->isMethod('POST')){  
        
        $admin = $request->input('admin');
            if($admin['role_id'] == 1){
                return $next($request);
            } 
      
      }


      if($request->isMethod('GET')){
                    
            $title = Auth::guard('admin')->user()->role->title;
        
            if($title == 'SuperAdmin') {
         
                return $next($request);

            }
            else {
                //Access Forbidden for admin without the required role
                abort(403);
            }
         
             
      }
  
    }
}
