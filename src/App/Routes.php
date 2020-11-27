<?php

declare(strict_types=1);

use Alfa\Handler\GetAllCharactersHandler;
use Alfa\Handler\GetCharactersByIdHandler;
use Alfa\Middlewares\Authentication;
use Alfa\Middlewares\Cache;
use Alfa\Middlewares\Log;
use Slim\Routing\RouteCollectorProxy;

$app->group('/got/personagens', function (RouteCollectorProxy $group) {

    $group->get('[/]', GetAllCharactersHandler::class)->add(new Authentication)
        ->add(new Log())
        ->add(new Cache());

    $group->get('/{id}', GetCharactersByIdHandler::class)->add(new Authentication)
        ->add(new Log())
        ->add(new Cache());
});

