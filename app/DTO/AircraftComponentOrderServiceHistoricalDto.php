<?php

namespace App\DTO;

final class AircraftComponentOrderServiceHistoricalDto
{
    public function __construct(
        public readonly int $aircraft_component_id,
        public readonly int $aircraft_id,
        public readonly ?int $component_model_id = null,
        public readonly string $component,
        public readonly ?string $component_text = "",
        public readonly ?string $serial_number = null,
        public readonly ?string $manufacturer = null,
        public readonly ?string $group = null,
        public readonly ?float $tsn = null,
        public readonly ?float $tso = null,
        public readonly ?float $csn = null,
        public readonly ?float $cso = null,
        public readonly ?string $tsn_status = null,
        public readonly ?string $tso_status = null,
        public readonly ?string $csn_status = null,
        public readonly ?string $cso_status = null,
        public readonly ?string $model = null,
    ) {}
}
