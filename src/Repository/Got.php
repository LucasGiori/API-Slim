<?php 

declare(strict_types=1);

namespace Alfa\Repository;

use GuzzleHttp\Client;
use Alfa\Entity\Got as EntityGot;
use Alfa\Handler\BaseHandler;

final class Got extends BaseHandler implements GotRepositoryInterface
{
    protected Client $client;
    protected string $host = 'https://thronesapi.com/api/v2/Characters';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAll():array
    {
        $res = $this->client->request('GET', $this->host,[
            "headers" => [
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ]
        ]);
        $array = json_decode($res->getBody()->getContents());
        return $array;
    }

    public function getById(int $id): object
    {
        $res = $this->client->request('GET', $this->host.'/'.$id,[
            "headers" => [
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ]
        ]);
        
        return json_decode($res->getBody()->getContents());
    }
}