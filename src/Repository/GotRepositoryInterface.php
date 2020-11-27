<?php

declare(strict_types=1);

namespace Alfa\Repository;

use Alfa\Entity\Got;

interface GotRepositoryInterface
{
    public function getAll ():array;
    public function getById(int $id):object;
}