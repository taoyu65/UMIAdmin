<?php

namespace YM\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    protected $languages = ['en','zh_cn'];

    public function handle(Request $request, Closure $next)
    {
        if(!Session::has('lang'))
        {
            Session::put('lang', $request->getPreferredLanguage($this->languages));
        }
        app()->setLocale(Session::get('lang'));
        return $next($request);
    }
}