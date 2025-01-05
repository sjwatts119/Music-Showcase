<?php

namespace App\DTOs;

interface DataTransferObject
{
    public static function fromArray(array $data): self;
}
