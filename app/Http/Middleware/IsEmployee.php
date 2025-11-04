<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class IsEmployee
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'employee') {
            abort(403, 'Unauthorized: Employee access required.');
        }
        return $next($request);
    }
}