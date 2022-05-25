<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\visitorWeb;

class SaveIpUser
{
    public function handle(Request $request, Closure $next)
    {
        $CheckIp = visitorWeb::where('ip',$request->getClientIp())->count();
        if($CheckIp >0)
        {
            $visitorWeb = visitorWeb::where('ip',$request->getClientIp())->first();
            visitorWeb::where('ip',$request->getClientIp())->update(['count' => $visitorWeb->count+1]);
        }
        else
        {
            $visitorWeb = new visitorWeb();
            $visitorWeb->count = 1;
            $visitorWeb->ip = $request->getClientIp();
            $visitorWeb->save();
        }
        return $next($request);
    }

    
}
