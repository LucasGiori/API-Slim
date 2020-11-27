<?php

declare(strict_types = 1);

namespace Alfa\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

final class Cache
{
    public function __invoke(Request $request, RequestHandlerInterface $handler)
    {
        $id = (string)explode("/",$request->getServerParams()['REQUEST_URI'])[3];
       
        $response = new Response();
        if($id == ''){
            $name = __DIR__.'/../data/cache/personagens.json';
        }else{
            $name = __DIR__.'/../data/cache/personagens'.$id.'.json';
        }
        
        if (file_exists($name)){
            $request = $request->withAttribute("cache",file_get_contents($name));
        }

        $response = $handler->handle($request);
        
        if(!file_exists($name)){
            file_put_contents($name,$response->getBody());
        }
        return $response;
    }

}