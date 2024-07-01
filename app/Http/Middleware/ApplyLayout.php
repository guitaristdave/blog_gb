<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApplyLayout
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if (
            $response->getStatusCode() !== 200 ||
            $response instanceof \Illuminate\Http\RedirectResponse ||
            $response instanceof \Illuminate\Http\JsonResponse
        ) {
            // TODO передавать сессионные переменные
//            if (session('message')) {
//                session()->put(session('message'));
//            }
            return $response;
        }
//        dd(session('message'));
        return response()->view('layouts.main', ['slot' => $response->original]);
    }
}
