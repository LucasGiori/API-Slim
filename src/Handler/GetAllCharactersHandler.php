<?php

declare(strict_types=1);

namespace Alfa\Handler;

use Alfa\Entity\Got;
use Alfa\Repository\Got as RepositoryGot;
use Alfa\Service\Got as ServiceGot;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;


final class GetAllCharactersHandler extends BaseHandler
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface
    {
        if ($request->getAttribute("cache")){
            $response->getBody()->write($request->getAttribute("cache"));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_OK);
        }
        $gotRepository =  new RepositoryGot(new Client());
        $gotService = new ServiceGot($gotRepository);
        $result = $gotService->getAll();
        $response->getBody()->write(json_encode($result));
        return $response->withStatus(200);
    }
}