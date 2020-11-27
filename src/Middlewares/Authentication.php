<?php

declare(strict_types = 1);

namespace Alfa\Middlewares;

use Exception;
use Alfa\Http\Response\ApiResponse;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response;

use Psr\Http\Server\RequestHandlerInterface;

final class Authentication
{
    
    public function __invoke(Request $request, RequestHandlerInterface $handler) :Response
    {

        $response = new Response();

        $authorization = $request->getHeaders()['Authorization'];
        if (!isset($authorization[0])) {       
            $response->getBody()->write(json_encode(["message"=>"Token não informado!"]));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_BAD_REQUEST);
        }

        list($token) = sscanf($authorization[0],'Basic %s');
        
        if (!$token) {
            $response->getBody()->write(json_encode(["message"=>"Token mal informado!"]));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_BAD_REQUEST);
        }

        list($usuario , $senha) =  explode(":",base64_decode($token));
        
        if (!($usuario === "usuario" && $senha === "senha"))
        {
            $response->getBody()->write(json_encode(["message"=>"Usuário ou senha Incorreto!"]));
            return $response->withHeader('Content-Type','application/json')->withStatus(StatusCodeInterface::STATUS_UNAUTHORIZED);
        }

        $response = $handler->handle($request);
        return $response;
    }
   

}