@extends('layouts.base_pdf', [
    'title' => 'Order service',
])
<?php
/** @var \App\DTO\OrderServiceDto $order_service */
?>
@section('content')
    <div style="padding:10px;">
        <table style="border: 1px solid #ddd;width:100%;border-collapse: collapse;">
            <tr align="center">
                <td style="border: 1px solid #ddd;padding:16px;vertical-align: middle" align="center" width="15%">
                    <img
                        src="https://mxgo-storage.s3.us-east-1.amazonaws.com/documents/bLxQ3TIv5Po42S6saYqbnjx6fv5jzm9cOpbbqeJs.png"
                        alt="Logo da oficina" height="80" style="text-align:center">
                </td>
                <td style="border: 1px solid #ddd;padding:16px;vertical-align: middle;" align="center" width="100%">
                    <h3 style="margin:0;font-weight:bold;vertical-align: middle;">
                        {{ $order_service->garage->name }}</h3>
                    <p style="margin:0;font-size: 14px;">
                        {{ $order_service->garage->city }}/{{ $order_service->garage->state }} - COM
                        {{ $order_service->garage->licence_number }}/ANAC</p>
                </td>
                <td style="border: 1px solid #ddd;vertical-align: middle;padding:16px" width="15%" align="center">
                    @if (isset($order_service->number_form) && !is_null($order_service->number_form))
                        <p style="font-size: 14px;">{{ $order_service->number_form }}</p>
                    @endif
                    @if (isset($order_service->date_form) && !is_null($order_service->date_form))
                        <p style="font-size: 14px;">{{\Carbon\Carbon::parse($order_service->date_form)->format('d/m/Y')}}</p>
                    @endif
                </td>
            </tr>
        </table>

        <table style="margin: 4px 0;width:100%;">
            <tr>
                <td>
                    <h2 style="margin:0px;text-align:center;font-weight:bold;">OS
                        {{ $order_service->code_text }}/{{ $order_service->created_at_year }}</h2>
                </td>
                <td>
                    <h2 style="margin:0px;text-align:center;font-weight:bold;">
                        {{ $order_service->aircraft_registration }}
                    </h2>
                </td>
            </tr>
        </table>

        @if (!is_null($order_service->aircraft))
            <table style="border: 1px solid #ddd;width:100%;border-collapse: collapse;">
                @foreach ($order_service->aircraft as $component)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td>
                            <p style="padding:0;text-align:center;font-size:12px;">{{ $component->component_text }}</p>
                        </td>
                        <td style="padding:20px;border-left: 1px solid #ddd;">
                            <table style="width:100%;border-collapse: collapse;">
                                <tr>
                                    <td width="20%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">SN:
                                            {{ $component->serial_number }}</p>
                                    </td>
                                    <td width="20%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">Modelo:
                                            {{ $component->model }}</p>
                                    </td>
                                    <td width="30%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">Fabricante:
                                            {{ $component->manufacturer }}</p>
                                    </td>
                                    <td width="30%">
                                        {{-- @if ($component->component == App\Constants::COMPONENT_AIRFRAME)--}}
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">Ano de
                                            Fabricação:
                                            {{ $order_service->year_manufacture }}</p>
                                        @{{--endif--}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">TSN:
                                            @include('pdf.order-service.components.aircraft_component_status', [
                                                'status' => $component->tsn_status,
                                                'value' => $component->tsn,
                                            ])
                                        </p>
                                    </td>
                                    <td width="20%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">TSO:
                                            @include('pdf.order-service.components.aircraft_component_status', [
                                                'status' => $component->tso_status,
                                                'value' => $component->tso,
                                            ])
                                        </p>
                                    </td>
                                    <td width="30%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">CSN:
                                            @include('pdf.order-service.components.aircraft_component_status', [
                                                'status' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->csn_status,
                                                'value' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->csn,
                                            ])
                                        </p>
                                    </td>
                                    <td width="30%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">CSO:
                                            @include('pdf.order-service.components.aircraft_component_status', [
                                                'status' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->cso_status,
                                                'value' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->cso,
                                            ])
                                        </p>
                                    </td>
                                </tr>
                                <tr class="font-12">
                                    <td style="border: none!important;" colspan="5">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">
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
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif

        <table style="border: 1px solid #ddd;width:100%;border-top: none!important;">
            <tr>
                <td style="padding:20px;">
                    @if (!is_null($order_service->date_start))
                        <p style="margin: 0;padding:0;font-size:14px;text-align:center;">
                            Data de Início:
                            {{ \Carbon\Carbon::parse($order_service->date_start)->format('d/m/Y')}}
                        </p>
                    @endif
                </td>
                <td style="padding:20px;">
                    @if (!is_null($order_service->date_end))
                        <p style="margin: 0;padding:0;font-size:14px;text-align:center;">
                            Término Previsto:
                            {{ \Carbon\Carbon::parse($order_service->date_end)->format('d/m/Y')}}
                        </p>
                    @endif
                </td>
            </tr>
        </table>

        <table
            style="border: 1px solid #ddd;width:100%;border-collapse: collapse;border-top: none!important;border-bottom:none!important;">
            <tr>
                <td style="padding:20px;">
                    <p style="text-align:center;">RESUMO DE ITENS EXECUTADOS</p>
                </td>
            </tr>
        </table>

        @php
            $items = $order_service->items->filter(fn ($item) => $item->type === App\Constants::SERVICE)->values();
        @endphp


        <table style="border: 1px solid #ddd;width:100%;border-collapse: collapse;">
            @foreach ($items as $key => $item)
                <tr>
                    <td style="padding:10px;border-right: 1px solid #ddd" width="1%">
                        <p style="margin: 0;padding:0;font-size:12px;">{{ $key + 1  }}</p>
                    </td>
                    <td style="padding:10px;">
                        <p style="margin: 0;padding:0;font-size:14px;">
                            {{ $item->description }}
                        </p>

                        <p style="margin: 0;padding:0;font-size:12px;">
                            @if (isset($item->pn) && !is_null($item->pn))
                                <span>PN: {{ $item->pn }}</span>
                            @endif
                            @if (isset($item->serial_number) && !is_null($item->serial_number))
                                <span> | SN: {{ $item->serial_number }}</span>
                            @endif
                        </p>
                        <p style="margin: 0;padding:0;font-size:12px;">
                                <span>
                                    Intervalo:
                                </span>
                            <span>
                                    @include('pdf.order-service.components.maintenance_date', [
                                        'date' => $item->interval_quantity,
                                        'unit_measurement' => $item->interval_unit_measurement,
                                    ])
                                </span>
                            <span>
                                    | Horas:
                                    @include('pdf.order-service.components.maintenance_hours', [
                                        'hours' => $item->interval_hours,
                                    ])
                                </span>
                            <span>
                                    | Ciclos
                                    @include('pdf.order-service.components.maintenance_cycles', [
                                        'cycles' => $item->interval_cycles,
                                    ])
                                </span>
                        </p>

                        <p style="margin: 0;padding:0;font-size:12px;">
                            Equipe:
                            {{ $item?->team_text }}
                        </p>

                    </td>
                </tr>
            @endforeach
        </table>

        <table style="border: 1px solid #ddd;width:100%;border-collapse:collapse;margin-top:4px;">
            <tr>
                <td style="padding:10px;" align="center">
                    <h4 style="text-align: center;">DECLARAÇÃO DE AERONAVEGABILIDADE</h4> <br/>
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
                                <a href="{{ $order_service->file_discrepancy_signed }}" style="color: #D24614"> (link da
                                    ficha)</a>
                            @endif
                        @endif
                        @if ($order_service->type_airworthiness == 'not_airworthy')
                            Declaro para os devidos fins que os serviços efetuados através desta Ordem de Serviço foram
                            realizados de acordo com os Dados Técnicos e os Regulamentos aplicáveis e que após a
                            inspeção de
                            qualidade das partes afetadas foram consideradas REPROVADAS para retorno ao serviço.
                            @if (isset($order_service->file_discrepancy_signed) && !is_null($order_service->file_discrepancy_signed))
                                <a href="{{ $order_service->file_discrepancy_signed }}" style="color: #D24614"> (link da
                                    ficha)</a>
                            @endif
                        @endif
                    @endif

                    <br/>
                    <br/>
                    <br/>
                    <span style="text-align: center;display:block">_________________________________________________________</span>
                    <br/>

                    <p>Assinatura do Inspetor Responsável</p>
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
                </td>
            </tr>
        </table>
    </div>
@endsection
