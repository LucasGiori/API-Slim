<?php 

declare(strict_types=1);

require __DIR__.'/../../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
if (!file_exists(__DIR__ . '/../../.env')){
    throw new Exception('Arquivo .env não encontrado');
}

$dotenv->load(__DIR__ . '/../../.env');

$app = AppFactory::create();
$app->addErrorMiddleware(true,true,true);

require __DIR__ . '/Routes.php';



