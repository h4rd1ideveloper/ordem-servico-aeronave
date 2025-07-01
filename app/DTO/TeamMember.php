<?php

namespace App\DTO;

class TeamMember
{
    public function __construct(
        public string $name,
        public string $role,
        public string $role_text
    ) {}
}

