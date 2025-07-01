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
        public array $items,
        public Garage $garage,
        public string $uuid,
        public string $customer_name,
        public string $customer_email,
        public string $customer_phone,
        public string $created_at,
        public string $updated_at,
        public string $status,
        public bool $can_edit,
        public int $year_manufacture,
        public bool $has_propeller,
        public float $total,
        public float $total_services,
        public float $total_parts,
        public string $operator_name,
        public string $operator_email,
        public string $operator_phone,
        public ?int $responsible_user_id,
        public ?object $responsible_user,
        public ?string $cancellation,
        public string $number_form,
        public string $date_start,
        public string $date_end,
        public string $date_form,
        public ?string $closed_at,
        public ?string $closed_by,
        public ?string $notes,
        public ?string $url,
        public string $local,
        public ?string $file_discrepancy,
        public ?string $file_discrepancy_signed,
        public ?string $file_signed_uploaded_at,
        public ?string $type_airworthiness,
        public ?string $type_inspection,
        public ?string $description_discrepancy,
        public ?string $responsible_name_discrepancy,
        public ?string $responsible_licence_discrepancy,
        public ?string $operator_name_discrepancy,
        public ?string $operator_licence_discrepancy,
        /** @var Revision[] */
        public array $revisions,
        /** @var array */
        public array $tools


    ) {}
}
