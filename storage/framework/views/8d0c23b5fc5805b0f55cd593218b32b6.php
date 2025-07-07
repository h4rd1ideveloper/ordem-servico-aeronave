<?php $__env->startSection('content'); ?>
    <?php
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
    ?>

    <div style="padding: 0;">
        <!-- Texto introdutório -->
        <div style="margin-bottom: 20px; page-break-inside: avoid;">
            <p style="font-size: 12px; margin-bottom: 10px; line-height: 1.4;">
                Nesta data, efetuamos os serviços relacionados na Aeronave Modelo
                <span style="font-weight: bold;"><?php echo e($dadosAeronave['modelo']); ?></span>
                com TSN <span style="font-weight: bold;"><?php echo e($dadosAeronave['tsn']); ?></span>
                CSN <span style="font-weight: bold;"><?php echo e($dadosAeronave['csn']); ?></span>
                conforme OS <span style="font-weight: bold;"><?php echo e($dadosAeronave['os_numero']); ?></span>
                serial <span style="font-weight: bold;"><?php echo e($dadosAeronave['serial']); ?></span>
                matrícula <span style="font-weight: bold;"><?php echo e($dadosAeronave['matricula']); ?></span>
            </p>
            <p style="font-size: 10px; margin-bottom: 20px; line-height: 1.3; color: #555;">
                (On the specified date above, we performed maintenance tasks on the aircraft model:
                <span style="font-weight: bold;"><?php echo e($dadosAeronave['aircraft_model']); ?></span>
                Registration: <span style="font-weight: bold;"><?php echo e($dadosAeronave['registration']); ?></span>
                TSN: <span style="font-weight: bold;"><?php echo e($dadosAeronave['tsn_en']); ?></span>
                CSN: <span style="font-weight: bold;"><?php echo e($dadosAeronave['csn_en']); ?></span>
                As described in Work Order: <span style="font-weight: bold;"><?php echo e($dadosAeronave['work_order']); ?></span>)
            </p>
        </div>

        <!-- Tabela de serviços -->
        <table class="service-table">
            <?php $__currentLoopData = $servicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="page-break-avoid">
                    <td class="item-number"><?php echo e($servico['numero']); ?></td>
                    <td class="item-description">
                        <p style="font-size: 12px; margin-bottom: 5px; line-height: 1.3;">
                            <?php echo e($servico['descricao']); ?>

                        </p>
                        <p style="font-size: 10px; color: #555; margin: 0; line-height: 1.2;">
                            <?php echo e($servico['detalhes']); ?>

                        </p>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make(
    'layouts.base_pdf_repeated_header_footer',
    [
        'title' => 'Registro Técnico',
        'header_content' => view('components.header_registro_tecnico')->render(),
        'footer_content' => view('components.footer_registro_tecnico')->render(),
    ]
, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/pdf/registro-tecnico.blade.php ENDPATH**/ ?>