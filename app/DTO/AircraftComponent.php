<?php

namespace App\DTO;

class AircraftComponent
{
    public function __construct(
        public int $aircraft_component_id,
        public int $aircraft_id,
        public int $component_model_id,
        public string $component,
        public string $component_text,
        public string $serial_number,
        public string $manufacturer,
        public string $group,
        public ?float $tsn,
        public ?float $tso,
        public ?int $csn,
        public ?float $cso,
        public ?string $tsn_status,
        public ?string $tso_status,
        public ?string $csn_status,
        public ?string $cso_status,
        public string $model
    ) {}
}

