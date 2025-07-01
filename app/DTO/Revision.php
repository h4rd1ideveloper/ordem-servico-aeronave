<?php

namespace App\DTO;

class Revision
{
    public function __construct(
        public int $id,
        public string $group,
        public string $name,
        public string $manual,
        public string $pn
    ) {}
}
