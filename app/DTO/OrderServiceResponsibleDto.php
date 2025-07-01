<?php

namespace App\DTO;

final class OrderServiceResponsibleDto
{
   public function __construct(
      public readonly int $id,
      public readonly string $name,
      public readonly string $email,
      public readonly ?string $license_1 = null,
      public readonly ?string $license_2 = null,
   ) {
   }
}
