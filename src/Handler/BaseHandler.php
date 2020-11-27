<?php

declare(strict_types=1);

namespace Alfa\Handler;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BaseHandler
{
    protected $serializer;

    public function __construct()
    {
        $enconders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $enconders);
    }
}