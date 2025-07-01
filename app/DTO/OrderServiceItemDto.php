<?php

namespace App\DTO;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class OrderServiceItemDto
{
    public function __construct(
        public readonly int $id,
        public readonly int $order_service_id,
        public readonly string $description,
        public readonly string $uuid,
        public readonly string $type,
        public readonly int $quantity,
        public readonly float $total,
        public readonly bool $item_inspection_mandatory,
        public readonly ?bool $is_troubleshooting = false,
        public readonly ?string $pn,
        public readonly ?string $serial_number,
        public readonly ?string $sheet_service,
        public readonly ?string $key_maintenance,
        public readonly ?int $service_id,
        public readonly ?int $part_id,
        public readonly ?string $status,
        public readonly ?string $status_task,
        public readonly ?string $hours_executed = null,
        public readonly ?string $hours_manual = null,
        public readonly ?string $number = null,
        public readonly ?int $interval_quantity = null,
        public readonly ?string $interval_unit_measurement = null,
        public readonly ?float $interval_hours = null,
        public readonly ?float $interval_cycles = null,
        public readonly ?Carbon $update_service_at,
        public readonly ?Maintenance $maintenance = null,
        public readonly ?Carbon $date_start = null,
        public readonly ?Carbon $date_end = null,
        public readonly ?Collection $team = new Collection([]),
    ) {}
}
