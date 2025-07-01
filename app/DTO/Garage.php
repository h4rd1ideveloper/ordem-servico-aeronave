<?php

namespace App\DTO;

class Garage
{
    public function __construct(
        public string $uuid,
        public string $name,
        public string $document,
        public string $email,
        public string $phone_1,
        public ?string $phone_2,
        public string $full_address,
        public string $street,
        public string $number,
        public string $neighborhood,
        public string $city,
        public string $state,
        public string $zipcode,
        public ?string $status,
        public ?string $maintenance_organization_certificate,
        public ?string $operational_specifications_certificate,
        public ?string $articles_of_association,
        public ?string $rejection_message,
        public ?string $licence_number,
        public ?string $url_logo,
        public ?string $web_site,
        public ?string $representative_garage,
        public ?string $owner
    ) {}
}
