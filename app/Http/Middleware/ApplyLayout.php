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

        // Проверка статуса и типов ответов
        if (
            $response->getStatusCode() !== 200 ||
            $response instanceof \Illuminate\Http\RedirectResponse ||
            $response instanceof \Illuminate\Http\JsonResponse
        ) {
            return $response;
        }

        // Проверка на HTML-содержимое
        if ($this->isHtmlResponse($response)) {
            $response = response()->view(
                'layouts.main',
                [
                    '*' => $response->original,
                    'slot' => $response->getContent(),
                ],
                $response->getStatusCode(),
                $request->headers->all()
            );
        }

        return $response;
    }

    // Метод для проверки HTML-содержимого
    protected function isHtmlResponse(Response $response): bool
    {
        $contentType = $response->headers->get('Content-Type');
        return $contentType && str_contains(strtolower($contentType), 'text/html');
    }
}
