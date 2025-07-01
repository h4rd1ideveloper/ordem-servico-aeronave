<?php

namespace App\DTO;

class Maintenance
{
    public function __construct(
        public int $id,
        public int $aircraft_id,
        public int $aircraft_component_id,
        public int $service_id,
        public string $context,
        public ?int $category_service_id,
        public string $key,
        public ?string $date,
        public ?string $unit_measurement,
        public ?string $task_number,
        public ?string $service_bulletin,
        public ?string $category,
        public ?string $primary_register,
        public ?string $pn,
        public ?string $part_serial_number,
        public ?string $type,
        public ?int $interval_quantity,
        public ?string $interval_unit_measurement,
        public ?float $interval_hours,
        public ?int $interval_cycles,
        public ?string $performed_date,
        public ?string $performed_date_short,
        public ?float $performed_hours,
        public ?int $performed_cycles,
        public ?string $due_date,
        public ?string $due_date_short,
        public ?float $due_hours,
        public ?int $due_cycles,
        public ?string $executed_by,
        public ?string $notes,
        public ?string $status,
        public string $frequency_description,
        public ?int $availability_days,
        public ?int $availability_hours,
        public ?int $availability_cycles,
        public int $comments_count,
        public ?string $order_service_code_text,
        public ?string $order_service_uuid,
        public ?string $budget_code_text,
        public ?string $budget_uuid,
        public bool $by_adjustments,
        public ?float $tsn,
        public ?float $tso,
        public ?int $csn,
        public ?float $cso,
        public ?string $cso_status,
        public ?string $tsn_status,
        public ?string $tso_status,
        public ?string $csn_status,
        /** @var string[] */
        public array $tags
    ) {}
}

