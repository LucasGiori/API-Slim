<?php

declare(strict_types = 1);

namespace Alfa\Service;

use Alfa\Entity\Got as EntityGot;
use Alfa\Repository\GotRepositoryInterface;


final class Got
{
    protected $gotRepository;
    
    public function __construct(GotRepositoryInterface $gotRepository)
    {
        $this->gotRepository = $gotRepository;
    }

    public function getAll():array
    {
        $arrayCharacters = $this->gotRepository->getAll();
        $newArrayCharacters = [];

        foreach ($arrayCharacters as $key => $value) {
            array_push($newArrayCharacters, [
                'id'=>$value->id,
                'nomeCompleto'=>$value->fullName,
                'urlImagem'=>$value->imageUrl
            ]);
        };
        return $newArrayCharacters;
    }
    public function getById(int $id):array
    {
        $character = $this->gotRepository->getById($id);
        
        $newCharacter = [
            'id'=>$character->id,
            'nomeCompleto'=>$character->fullName,
            'urlImagem'=>$character->imageUrl
        ];
        return $newCharacter;
    }
}