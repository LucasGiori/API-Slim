<?php

declare(strict_types = 1);

namespace Alfa\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;

final class Log
{
    public function __invoke(Request $request, RequestHandlerInterface $handler)
    {
        $inicio = microtime(true);
        $response = $handler->handle($request);
        $fim = microtime(true);
        file_put_contents(
            __DIR__."/../data/log/access.log",
            sprintf("%s [%s] %s %ss\n",
                date('d/m/Y H:i:s'),
                $request->getMethod(),
                $request->getUri(),
                round($fim-$inicio,2)
            ),
            FILE_APPEND
        );
        return $response;
    }

}