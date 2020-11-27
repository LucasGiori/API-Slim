<?php

declare(strict_types=1);

namespace Alfa\Entity;

class Got
{
    protected int $id;
    protected string $fullName;
    protected string $imageUrl;

    public function __construct(){}

    public function getId() :int
    {
        return $this->id;
    }
    public function setId(int $id) :void
    {
        $this->id = $id;
    }

    public function getFullName() :string
    {
        return $this->fullName;
    }
    public function setFullName(string $fullName) :void
    {
        $this->fullName = $fullName;
    }

    public function getImageUrl() :string
    {
        return $this->imageUrl;
    }
    public function setImageUrl(string $imageUrl) :void
    {
        $this->imageUrl = $imageUrl;
    }
}