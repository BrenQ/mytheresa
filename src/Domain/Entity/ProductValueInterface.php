<?php

namespace App\Domain\Entity;

interface ProductValueInterface
{
    public function value():string;
    public function name():string;
}