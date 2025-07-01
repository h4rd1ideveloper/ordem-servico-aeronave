<?php

namespace App\DTO;

class OrderItem
{
    public function __construct(
        public int $id,
        public ?int $order_service_id,
        public string $description,
        public string $uuid,
        public string $type,
        public int $quantity,
        public float|int $total,
        public bool $item_inspection_mandatory,
        public bool $is_troubleshooting,
        public ?string $pn,
        public ?string $serial_number,
        public ?string $sheet_service,
        public ?string $key_maintenance,
        public ?int $service_id,
        public ?int $part_id,
        public string $status,
        public string $status_task,
        public ?float $hours_executed,
        public ?float $hours_manual,
        public string $number,
        public ?int $interval_quantity,
        public ?string $interval_unit_measurement,
        public ?float $interval_hours,
        public ?int $interval_cycles,
        public ?string $update_service_at,
        public Maintenance|null $maintenance,
        public ?string $date_start,
        public ?string $date_end,
        /** @var TeamMember[] */
        public array $team,
        public string $team_text,
        public array $actions,
        public array $traceabilitys,
        public array $tools
    ) {}
}
