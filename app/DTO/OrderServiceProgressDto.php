<?php

namespace App\DTO;

final class OrderServiceProgressDto
{
   public function __construct(
      public float $percent,
      public string $description,
      public string $type,
      public bool $is_late,
   ) {}
}
