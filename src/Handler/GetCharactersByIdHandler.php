<?php

declare(strict_types=1);

namespace Alfa\Handler;

use Alfa\Entity\Got;
use Alfa\Repository\Got as RepositoryGot;
use Alfa\Service\Got as ServiceGot;
use Psr\Http\Message\ServerRequestInterface;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;


final class GetCharactersByIdHandler extends BaseHandler
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response,$args) : ResponseInterface
    {
        if ($request->getAttribute("cache")){
            $response->getBody()->write($request->getAttribute("cache"));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_OK);
        }

        $gotRepository =  new RepositoryGot(new Client());
        $gotService = new ServiceGot($gotRepository);
        $result = $gotService->getById((int)$args['id']);
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_OK);
    }
}