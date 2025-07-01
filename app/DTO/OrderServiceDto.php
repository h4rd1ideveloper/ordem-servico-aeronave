<?php

namespace App\DTO;

use Carbon\Carbon;
use Illuminate\Support\Collection;

final class OrderServiceDto
{
    public function __construct(
        public readonly int $id,
        public readonly int $code,
        public readonly string $code_text,
        public readonly string $aircraft_registration,
        public readonly string $aircraft_description,
        public readonly string $aircraft_uuid,
        public readonly string $aircraft_model_type,
        public readonly int $aircraft_id,
        public readonly string $created_at_year,
        /** @var AircraftComponentOrderServiceHistoricalDto[] $aircraft */
        public readonly Collection $aircraft,
        /** @var OrderServiceItemDto[] $items */
        public readonly Collection $items,
        public readonly string $uuid,
        public readonly string $customer_name,
        public readonly string $customer_email,
        public readonly string $customer_phone,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
        public readonly string $status,
        public readonly ?bool $can_edit = true,
        public readonly ?int $year_manufacture = null,
        public readonly ?bool $has_propeller = false,
        public readonly ?float $total = 0,
        public readonly ?float $total_services = 0,
        public readonly ?float $total_parts = 0,
        public readonly ?string $operator_name = null,
        public readonly ?string $operator_email = null,
        public readonly ?string $operator_phone = null,
        public readonly ?int $responsible_user_id = null,
        public readonly ?OrderServiceResponsibleDto $responsible_user = null,
        public readonly ?object $cancellation = null,
        public readonly ?OrderServiceProgressDto $progress = null,
        public readonly ?string $number_form = null,
        public readonly ?Carbon $date_start = null,
        public readonly ?Carbon $date_end = null,
        public readonly ?Carbon $date_form = null,
        public readonly ?Carbon $closed_at = null,
        public readonly ?OrderServiceClosedByDto $closed_by = null,
        public readonly ?Garage $garage = null,
        public readonly ?string $notes = null,
        public readonly ?string $url = null,
        public readonly ?string $local = null,
        public readonly ?string $file_discrepancy = null,
        public readonly ?string $file_discrepancy_signed = null,
        public readonly ?string $file_signed_uploaded_at = null,
        public readonly ?string $type_airworthiness = null,
        public readonly ?string $type_inspection = null,
        public readonly ?string $description_discrepancy = null,
        public readonly ?string $responsible_name_discrepancy = null,
        public readonly ?string $responsible_licence_discrepancy = null,
        public readonly ?string $operator_name_discrepancy = null,
        public readonly ?string $operator_licence_discrepancy = null,
        /** @var Revision[] $revisions */
        public readonly ?Collection $revisions = new Collection([]),
    ) {}
}
