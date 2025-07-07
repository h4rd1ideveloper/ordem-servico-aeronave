@extends(
    'layouts.base_pdf_repeated_header_footer',
    [
        'title' => 'Registro Técnico',
        'header_content' => view('components.header_registro_tecnico')->render(),
        'footer_content' => view('components.footer_registro_tecnico')->render(),
    ]
)

@section('content')
    @php
        // Dados de exemplo - substitua pelos dados reais
        $dadosAeronave = [
            'modelo' => 'MODELO_AERONAVE',
            'tsn' => 'TSN_VALOR',
            'csn' => 'CSN_VALOR',
            'os_numero' => 'OS_NUMERO',
            'serial' => 'SERIAL_NUMERO',
            'matricula' => 'MATRICULA_AERONAVE',
            'aircraft_model' => 'AIRCRAFT_MODEL',
            'registration' => 'REGISTRATION_VALUE',
            'tsn_en' => 'TSN_VALUE_EN',
            'csn_en' => 'CSN_VALUE_EN',
            'work_order' => 'WORK_ORDER_NUMBER'
        ];

        // Gerar serviços de exemplo - substitua pelos dados reais
        $servicos = [];
        for ($i = 1; $i <= 25; $i++) { // Aumentei para 25 para testar quebra de página
            $servicos[] = [
                'numero' => $i,
                'descricao' => "Descrição do item de serviço {$i}. Este é um texto de exemplo para demonstrar a quebra de linha e o comportamento do layout com conteúdo mais extenso.",
                'detalhes' => "Detalhes adicionais do serviço {$i}, incluindo informações sobre equipe responsável, horas de trabalho, ciclos de operação e outras especificações técnicas relevantes."
            ];
        }
    @endphp

    <div style="padding: 0;">
        <!-- Texto introdutório -->
        <div style="margin-bottom: 20px; page-break-inside: avoid;">
            <p style="font-size: 12px; margin-bottom: 10px; line-height: 1.4;">
                Nesta data, efetuamos os serviços relacionados na Aeronave Modelo
                <span style="font-weight: bold;">{{ $dadosAeronave['modelo'] }}</span>
                com TSN <span style="font-weight: bold;">{{ $dadosAeronave['tsn'] }}</span>
                CSN <span style="font-weight: bold;">{{ $dadosAeronave['csn'] }}</span>
                conforme OS <span style="font-weight: bold;">{{ $dadosAeronave['os_numero'] }}</span>
                serial <span style="font-weight: bold;">{{ $dadosAeronave['serial'] }}</span>
                matrícula <span style="font-weight: bold;">{{ $dadosAeronave['matricula'] }}</span>
            </p>
            <p style="font-size: 10px; margin-bottom: 20px; line-height: 1.3; color: #555;">
                (On the specified date above, we performed maintenance tasks on the aircraft model:
                <span style="font-weight: bold;">{{ $dadosAeronave['aircraft_model'] }}</span>
                Registration: <span style="font-weight: bold;">{{ $dadosAeronave['registration'] }}</span>
                TSN: <span style="font-weight: bold;">{{ $dadosAeronave['tsn_en'] }}</span>
                CSN: <span style="font-weight: bold;">{{ $dadosAeronave['csn_en'] }}</span>
                As described in Work Order: <span style="font-weight: bold;">{{ $dadosAeronave['work_order'] }}</span>)
            </p>
        </div>

        <!-- Tabela de serviços -->
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Descrição</th>
                <!-- … -->
            </tr>
            </thead>

            <tbody>
            @foreach($itens as $i => $item)
                <tr class="service-item">
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <strong>Descrição do item de serviço {{ $i + 1 }}.</strong>
                        {{ $item->descricao }}
                        @if($item->detalhes)
                            <div class="detalhes">
                                {{ $item->detalhes }}
                            </div>
                        @endif
                    </td>
                    <!-- … -->
                </tr>
            @endforeach
            </tbody>

            <tfoot>
            <tr>
                <td colspan="N">Rodapé da tabela (se necessário)</td>
            </tr>
            </tfoot>
        </table>
        <!-- Seção de assinatura -->
        <div class="signature-section">
            <p style="font-weight: bold; font-size: 14px; margin-bottom: 5px;">Inspetor APRS</p>
            <p style="font-size: 12px; margin-bottom: 5px;">Licença / CANAC</p>
            <p style="font-size: 10px; margin-bottom: 20px; color: #555;">(License number / ANAC Code)</p>
            <div class="signature-line"></div>
            <p style="font-size: 12px; margin-top: 5px;">Assinatura do Inspetor</p>
        </div>

        <!-- Declaração -->
        <div class="declaration-section">
            <p class="declaration-text" style="margin-bottom: 10px;">
                Declaramos que os serviços acima relacionados foram cumpridos de acordo com os Dados Técnicos e Regulamentos aplicáveis, estando o motor aprovado para retorno ao serviço.
            </p>
            <p class="declaration-text" style="color: #555;">
                We declare all maintenance tasks above described were performed in accordance with applicable Technical Data and Regulations, therefore the engine is approved to return to service.
            </p>
        </div>
    </div>
@endsection
