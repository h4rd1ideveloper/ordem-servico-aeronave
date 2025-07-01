<?php

namespace App\DTO;

class OrderService
{
    public function __construct(
        public int $id,
        public int $code,
        public string $code_text,
        public string $aircraft_registration,
        public string $aircraft_description,
        public string $aircraft_uuid,
        public string $aircraft_model_type,
        public int $aircraft_id,
        public string $created_at_year,
        /** @var AircraftComponent[] */
        public array $aircraft,
        /** @var OrderItem[] */
        public array $items
    ) {}
}
