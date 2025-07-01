<?php

namespace App\Helpers;

use App\DTO\Garage;
use App\DTO\Revision;
use RuntimeException;
use App\DTO\OrderService;
use App\DTO\AircraftComponent;
use App\DTO\OrderItem;
use App\DTO\Maintenance;
use App\DTO\TeamMember;

class JsonHelpers
{
    public static function getOrderServiceData(bool $asArray = true): OrderService
    {
        $jsonPath = base_path('assets/order_service.json');

        if (!file_exists($jsonPath)) {
            throw new RuntimeException('Arquivo order_service.json não encontrado em assets/');
        }

        $jsonString = file_get_contents($jsonPath);
        $dados = json_decode($jsonString, $asArray);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Erro ao fazer parse do JSON: ' . json_last_error_msg());
        }
        $order = $dados['order_service'];

        return new OrderService(
            id: $order['id'],
            code: $order['code'],
            code_text: $order['code_text'],
            aircraft_registration: $order['aircraft_registration'],
            aircraft_description: $order['aircraft_description'],
            aircraft_uuid: $order['aircraft_uuid'],
            aircraft_model_type: $order['aircraft_model_type'],
            aircraft_id: $order['aircraft_id'],
            created_at_year: $order['created_at_year'],
            aircraft: array_map(fn($a) => new AircraftComponent(...$a), $order['aircraft']),
            items: array_map(function ($i) {
                return new OrderItem(id: $i['id'],
                    order_service_id: $i['order_service_id'],
                    description: $i['description'],
                    uuid: $i['uuid'],
                    type: $i['type'],
                    quantity: $i['quantity'],
                    total: $i['total'],
                    item_inspection_mandatory: $i['item_inspection_mandatory'],
                    is_troubleshooting: $i['is_troubleshooting'],
                    pn: $i['pn'],
                    serial_number: $i['serial_number'],
                    sheet_service: $i['sheet_service'],
                    key_maintenance: $i['key_maintenance'],
                    service_id: $i['service_id'],
                    part_id: $i['part_id'],
                    status: $i['status'],
                    status_task: $i['status_task'],
                    hours_executed: $i['hours_executed'],
                    hours_manual: $i['hours_manual'],
                    number: $i['number'],
                    interval_quantity: $i['interval_quantity'],
                    interval_unit_measurement: $i['interval_unit_measurement'],
                    interval_hours: $i['interval_hours'],
                    interval_cycles: $i['interval_cycles'],
                    update_service_at: $i['update_service_at'],
                    maintenance:!empty($i['maintenance'])&&$i['maintenance']!= NULL? new Maintenance(
                        id: $i['maintenance']['id'],
                        aircraft_id: $i['maintenance']['aircraft_id'],
                        aircraft_component_id: $i['maintenance']['aircraft_component_id'],
                        service_id: $i['maintenance']['service_id'],
                        context: $i['maintenance']['context'],
                        category_service_id: $i['maintenance']['category_service_id'],
                        key: $i['maintenance']['key'],
                        date: $i['maintenance']['date'],
                        unit_measurement: $i['maintenance']['unit_measurement'],
                        task_number: $i['maintenance']['task_number'],
                        service_bulletin: $i['maintenance']['service_bulletin'],
                        category: $i['maintenance']['category'],
                        primary_register: $i['maintenance']['primary_register'],
                        pn: $i['maintenance']['pn'],
                        part_serial_number: $i['maintenance']['part_serial_number'],
                        type: $i['maintenance']['type'],
                        interval_quantity: $i['maintenance']['interval_quantity'],
                        interval_unit_measurement: $i['maintenance']['interval_unit_measurement'],
                        interval_hours: $i['maintenance']['interval_hours'],
                        interval_cycles: $i['maintenance']['interval_cycles'],
                        performed_date: $i['maintenance']['performed_date'],
                        performed_date_short: $i['maintenance']['performed_date_short'],
                        performed_hours: $i['maintenance']['performed_hours'],
                        performed_cycles: $i['maintenance']['performed_cycles'],
                        due_date: $i['maintenance']['due_date'],
                        due_date_short: $i['maintenance']['due_date_short'],
                        due_hours: $i['maintenance']['due_hours'],
                        due_cycles: $i['maintenance']['due_cycles'],
                        executed_by: $i['maintenance']['executed_by'],
                        notes: $i['maintenance']['notes'],
                        status: $i['maintenance']['status'],
                        frequency_description: $i['maintenance']['frequency_description'],
                        availability_days: $i['maintenance']['availability_days'],
                        availability_hours: $i['maintenance']['availability_hours'],
                        availability_cycles: $i['maintenance']['availability_cycles'],
                        comments_count: $i['maintenance']['comments_count'],
                        order_service_code_text: $i['maintenance']['order_service_code_text'],
                        order_service_uuid: $i['maintenance']['order_service_uuid'],
                        budget_code_text: $i['maintenance']['budget_code_text'],
                        budget_uuid: $i['maintenance']['budget_uuid'],
                        by_adjustments: $i['maintenance']['by_adjustments'],
                        tsn: $i['maintenance']['tsn'],
                        tso: $i['maintenance']['tso'],
                        csn: $i['maintenance']['csn'],
                        cso: $i['maintenance']['cso'],
                        cso_status: $i['maintenance']['cso_status'],
                        tsn_status: $i['maintenance']['tsn_status'],
                        tso_status: $i['maintenance']['tso_status'],
                        csn_status: $i['maintenance']['csn_status'],
                        tags: $i['maintenance']['tags']
                    ):NULL,
                    date_start: $i['date_start'],
                    date_end: $i['date_end'],
                    team: array_map(fn($t) => new TeamMember(...$t), $i['team']), team_text: $i['team_text'],
                    actions: $i['actions'],
                    traceabilitys: $i['traceabilitys'],
                    tools: $i['tools'],
                );
        }, $order['items']),
            garage: new Garage(
                uuid: $order['garage']['uuid'],
                name: $order['garage']['name'],
                document: $order['garage']['document'],
                email: $order['garage']['email'],
                phone_1: $order['garage']['phone_1'],
                phone_2: $order['garage']['phone_2'],
                full_address: $order['garage']['full_address'],
                street: $order['garage']['street'],
                number: $order['garage']['number'],
                neighborhood: $order['garage']['neighborhood'],
                city: $order['garage']['city'],
                state: $order['garage']['state'],
                zipcode: $order['garage']['zipcode'],
                status: $order['garage']['status'],
                maintenance_organization_certificate: $order['garage']['maintenance_organization_certificate'],
                operational_specifications_certificate: $order['garage']['operational_specifications_certificate'],
                articles_of_association: $order['garage']['articles_of_association'],
                rejection_message: $order['garage']['rejection_message'],
                licence_number: $order['garage']['licence_number'],
                url_logo: $order['garage']['url_logo'],
                web_site: $order['garage']['web_site'],
                representative_garage: $order['garage']['representative_garage'],
                owner: $order['garage']['owner']
            ),
            uuid: $order['uuid'],
            customer_name: $order['customer_name'],
            customer_email: $order['customer_email'],
            customer_phone: $order['customer_phone'],
            created_at: $order['created_at'],
            updated_at: $order['updated_at'],
            status: $order['status'],
            can_edit: $order['can_edit'],
            year_manufacture: $order['year_manufacture'],
            has_propeller: $order['has_propeller'],
            total: $order['total'],
            total_services: $order['total_services'],
            total_parts: $order['total_parts'],
            operator_name: $order['operator_name'],
            operator_email: $order['operator_email'],
            operator_phone: $order['operator_phone'],
            responsible_user_id: $order['responsible_user_id'],
            responsible_user: $order['responsible_user'],
            cancellation: $order['cancellation'],
            number_form: $order['number_form'],
            date_start: $order['date_start'],
            date_end: $order['date_end'],
            date_form: $order['date_form'],
            closed_at: $order['closed_at'],
            closed_by: $order['closed_by'],
            notes: $order['notes'],
            url: $order['url'],
            local: $order['local'],
            file_discrepancy: $order['file_discrepancy'],
            file_discrepancy_signed: $order['file_discrepancy_signed'],
            file_signed_uploaded_at: $order['file_signed_uploaded_at'],
            type_airworthiness: $order['type_airworthiness'],
            type_inspection: $order['type_inspection'],
            description_discrepancy: $order['description_discrepancy'],
            responsible_name_discrepancy: $order['responsible_name_discrepancy'],
            responsible_licence_discrepancy: $order['responsible_licence_discrepancy'],
            operator_name_discrepancy: $order['operator_name_discrepancy'],
            operator_licence_discrepancy: $order['operator_licence_discrepancy'],
            revisions: array_map(fn($r) => new Revision(
                id: $r['id'],
                group: $r['group'],
                name: $r['name'],
                manual: $r['manual'],
                pn: $r['pn']
            ), $order['revisions']),
            tools: $order['tools'],
        );
    }
}


