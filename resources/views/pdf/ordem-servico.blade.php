<?php
/** @var \App\DTO\OrderServiceDto $order_service */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordem de Serviço {{ $order_service?->number_form??$order_service->code_text }}</title>
    <style>
        @page {
            margin: 1cm 1cm 1cm 1cm;
            size: A4;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .header {
            display: table;
            width: 100%;
            table-layout: fixed;
            border: 1px solid #000;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .header-row {
            display: table-row;
        }

        .header-cell {
            display: table-cell;
            padding: 5px;
            vertical-align: middle;
        }

        .logo-cell {
            width: 25%;
            text-align: center;
            font-weight: bold;
            font-size: 14px;

            padding:16px;
            vertical-align: middle;

        }

        .company-cell {
            width: 60%;
            text-align: center;
            border-right: 1px solid #ddd;
            border-left: 1px solid #ddd;
        }

        .company-name {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 2px;
        }

        .company-address {
            font-size: 10px;
        }

        .doc-cell {
            width: 20%;
            text-align: center;

        }

        .doc-code {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 2px;
        }

        .doc-date {
            font-size: 9px;
        }

        .os-info {
            display: table;
            width: 100%;
            table-layout: fixed;
            border: 1px solid #000;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .os-row {
            display: table-row;
        }

        .os-cell {
            display: table-cell;
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .os-number {
            width: 50%;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .aircraft-reg {
            width: 50%;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .components-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            page-break-inside: avoid;
            table-layout: fixed;
        }

        .components-table th,
        .components-table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
            font-size: 9px;
            word-wrap: break-word;
        }

        .components-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .component-type {
            width: 15%;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        .component-details {
            width: 21.25%;
            max-width: 21.25%;
            overflow: hidden;
        }

        .dates-section {
            display: table;
            width: 100%;
            table-layout: fixed;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .dates-row {
            display: table-row;
        }

        .date-cell {
            display: table-cell;
            width: 50%;
            padding: 5px;
        }

        .date-label {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .services-title {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            margin: 15px 0 10px 0;
            page-break-after: avoid;
        }

        .service-item {
            display: table;
            width: 100%;
            table-layout: fixed;
            border: 1px solid #000;
            margin-bottom: 2px;
            page-break-inside: avoid;
            min-height: 40px;
        }

        .service-row {
            display: table-row;
        }

        .service-number {
            display: table-cell;
            width: 5%;
            border-right: 1px solid #000;
            padding: 5px;
            text-align: center;
            font-weight: bold;
            vertical-align: top;
        }

        .service-description {
            display: table-cell;
            width: 95%;
            padding: 5px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .service-desc-text {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .service-details {
            font-size: 9px;
            color: #333;
        }

        .declaration-section {
            margin-top: 20px;
            text-align: center;
            page-break-inside: avoid;
        }

        .declaration-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            width: 300px;
            margin: 30px auto 10px auto;
        }

        .signature-text {
            font-size: 10px;
            margin-top: 5px;
        }

        /* Quebra de página específica */
        .page-break {
            page-break-before: always;
        }

        .no-break {
            page-break-inside: avoid;
        }

        /* Estilos para páginas subsequentes */
        .continuation-header {
            height: 1cm;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<!-- Cabeçalho principal (apenas primeira página) -->
<div class="header">
    <div class="header-row">
        <div class="header-cell logo-cell" align="center" >
            <img
                src="https://mxgo-storage.s3.us-east-1.amazonaws.com/documents/bLxQ3TIv5Po42S6saYqbnjx6fv5jzm9cOpbbqeJs.png"
                alt="Logo da oficina" height="80" style="text-align:center;object-fit:contain">
        </div>
        <div class="header-cell company-cell">
            <div class="company-name"> {{ $order_service->garage->name }}</div>
            <div class="company-address">{{ $order_service->garage->city }}/{{ $order_service->garage->state }} - COM
                {{ $order_service->garage->licence_number }}/ANAC</div>
        </div>
        <div class="header-cell doc-cell">
            <div class="doc-code"> @if (isset($order_service->number_form) && !is_null($order_service->number_form))
                    {{ $order_service->number_form }}
                @endif</div>
            <div class="doc-date">@if (isset($order_service->date_form) && !is_null($order_service->date_form))
                    {{\Carbon\Carbon::parse($order_service->date_form)->format('d/m/Y')}}
                @endif</div>
        </div>
    </div>
</div>

<!-- Informações da OS -->
<div class="os-info">
    <div class="os-row">
        <div class="os-cell os-number">
            OS
            {{ $order_service->code_text }}/{{ $order_service->created_at_year }}
        </div>
        <div class="os-cell aircraft-reg">
            {{ $order_service->aircraft_registration }}
        </div>
    </div>
</div>

<!-- Tabela de componentes -->
<table class="components-table">
    @if(!is_null($order_service->aircraft))
        @foreach ($order_service->aircraft as $component)
            <tr>
            <td class="component-type">{{ $component->component_text }}</td>
            <td class="component-details">
                SN:
                {{ $component->serial_number }}<br>
                TSN:
                @include('pdf.order-service.components.aircraft_component_status', [
                    'status' => $component->tsn_status,
                    'value' => $component->tsn,
                ])<br>
                Revisão:
                @if($component->group === App\Constants::GROUP_PROPELLERS && !$order_service->has_propeller)
                    N/A
                @else
                    {{ $order_service->revisions->filter(fn($item) => $item->group === $component->group)->values()->reduce(function ($acc, $item, $idx) use ($order_service, $component) {
                        $acc .= "Manual:{$item->name} / Revision:{$item->manual} / PN:{$item->pn} ";
                        if (
                            $idx >= 0 &&
                            $idx <
                            $order_service->revisions->filter(fn($itemFilter) => $itemFilter->group === $component->group)->values()->count() - 1
                        ) {
                            $acc .= ' | ';
                        }
                        return $acc;
                    }, '') }}
                @endif
            </td>
            <td class="component-details">
                Modelo:
                {{ $component->model }}<br>
                TSO:
                @include('pdf.order-service.components.aircraft_component_status', [
                    'status' => $component->tso_status,
                    'value' => $component->tso,
                ])<br>
                CSN:
                @include('pdf.order-service.components.aircraft_component_status', [
                    'status' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->csn_status,
                    'value' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->csn,
                ])
            </td>
            <td class="component-details">
                Fabricante:
                {{ $component->manufacturer }}<br>
                CSO:
                @include('pdf.order-service.components.aircraft_component_status', [
                    'status' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->cso_status,
                    'value' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->cso,
                ])
            </td>
            <td class="component-details">
                Ano de Fabricação:
                {{ $order_service->year_manufacture }}
            </td>
        </tr>
        @endforeach
    @endif
</table>

<!-- Datas -->
<div class="dates-section">
    <div class="dates-row">
        <div class="date-cell">
            @if (!is_null($order_service->date_start))
                <div class="date-label"> Data de Início:
                    {{ \Carbon\Carbon::parse($order_service->date_start)->format('d/m/Y')}}</div>
            @endif
        </div>
        <div class="date-cell">
            <div class="date-label">
                @if (!is_null($order_service->date_end))
                    Término Previsto:
                    {{ \Carbon\Carbon::parse($order_service->date_end)->format('d/m/Y')}}
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Título dos serviços -->
<div class="services-title">RESUMO DE ITENS EXECUTADOS</div>
@php
    $items = $order_service->items->filter(fn ($item) => $item->type === App\Constants::SERVICE)->values();
@endphp
<!-- Lista de serviços -->
@foreach ($items as $key => $item)
    <div class="service-item no-break">
        <div class="service-row">
            <div class="service-number">{{ $key + 1  }}</div>
            <div class="service-description">
                <div class="service-desc-text">{{ $item->description }}</div>
                <div class="service-details">
                    @if(isset($item->pn) && !is_null($item->pn))
                        PN: {{ $item->pn }}
                    @endif
                    @if(isset($item->serial_number) && !is_null($item->serial_number))
                        | SN: {{ $item->serial_number }}
                    @endif
                        Intervalo:
                    @include('pdf.order-service.components.maintenance_date', [
                        'date' => $item->interval_quantity,
                        'unit_measurement' => $item->interval_unit_measurement,
                    ])
                    | Horas:
                    @include('pdf.order-service.components.maintenance_hours', [
                        'hours' => $item->interval_hours,
                    ])
                    | Ciclos
                    @include('pdf.order-service.components.maintenance_cycles', [
                        'cycles' => $item->interval_cycles,
                    ])
                    Equipe:
                    {{ $item?->team_text }}
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Declaração de aeronavegabilidade -->
<div class="declaration-section no-break">
    <div class="declaration-title">DECLARAÇÃO DE AERONAVEGABILIDADE</div>
    @if (isset($order_service->closed_at) && !is_null($order_service->closed_at))
        <span class="text-center" style="font-size:14px;display:block">OS encerrada na data de:
            {{\Carbon\Carbon::parse($order_service->closed_at)->format('d/m/Y')}}
        </span>
        <br/>
    @endif

    @if (isset($order_service->type_airworthiness) && !is_null($order_service->type_airworthiness))
        @if ($order_service->type_airworthiness == 'airworthy')
            Declaro para os devidos fins que os serviços efetuados através desta Ordem de Serviço foram
            realizados de acordo com os Dados Técnicos e os Regulamentos aplicáveis e que após a
            inspeção de
            qualidade das partes afetadas foram consideradas aprovadas para retorno ao serviço.
        @endif
        @if ($order_service->type_airworthiness == 'airworthy_with_restriction')
            Declaro para os devidos fins que os serviços efetuados através desta Ordem de Serviço foram
            realizados de acordo com os Dados Técnicos e os Regulamentos aplicáveis e que após a
            inspeção de
            qualidade das partes afetadas foram consideradas aprovadas para retorno ao serviço, com a
            ressalva conforme ficha de discrepância
            @if (isset($file_discrepancy_signed) && !is_null($order_service->file_discrepancy_signed))
                <a href="{{ $order_service->file_discrepancy_signed }}" style="color: #D24614"> (link da ficha)</a>
            @endif
        @endif
        @if ($order_service->type_airworthiness == 'not_airworthy')
            Declaro para os devidos fins que os serviços efetuados através desta Ordem de Serviço foram
            realizados de acordo com os Dados Técnicos e os Regulamentos aplicáveis e que após a
            inspeção de
            qualidade das partes afetadas foram consideradas REPROVADAS para retorno ao serviço.
            @if (isset($order_service->file_discrepancy_signed) && !is_null($order_service->file_discrepancy_signed))
                <a href="{{ $order_service->file_discrepancy_signed }}" style="color: #D24614"> (link da ficha)</a>
            @endif
        @endif
    @endif

    <br/>
    <br/>
    <br/>

    <div class="signature-line"></div>
    <div class="signature-text">
        Assinatura do Inspetor Responsável<br>
        <p style="font-size: 14px;">
            @if (!is_null($order_service->responsible_user))
                {{ $order_service->responsible_user->name }}
                @if (!is_null($order_service->responsible_user->license_1))
                    {{ ' / Licença.:' . $order_service->responsible_user->license_1 }}
                @endif
                @if (!is_null($order_service->responsible_user->license_2))
                    {{ ' / Codigo ANAC Nr.:' . $order_service->responsible_user->license_2 }}
                @endif
            @endif
        </p>
        @if (!is_null($order_service->local))
            <p style="margin: 0">{{ $order_service->local }}</p>
        @endif
    </div>
</div>
</body>
</html>

