<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ApplyLayout
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     * @throws \Throwable
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if (
            !$response instanceof View &&
            !str_contains(
                strtolower($response->getContent()),
                strtolower('<!DOCTYPE html>')
            )
        ) {
            $response = response()->view('main', ['slot' => $response->getContent()]);
        }
        return $response;
    }
}
