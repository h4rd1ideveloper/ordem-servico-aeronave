<?php

namespace App\DTO;

final class OrderServiceClosedByDto
{
   public function __construct(
      public readonly int $id,
      public readonly string $name,
      public readonly string $email,
   ) {
   }
}
