<?php
/** @var \App\DTO\OrderService $order_service */
?>
<?php $__env->startSection('content'); ?>
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
                        <?php echo e($order_service->garage->name); ?></h3>
                    <p style="margin:0;font-size: 14px;">
                        <?php echo e($order_service->garage->city); ?>/<?php echo e($order_service->garage->state); ?> - COM
                        <?php echo e($order_service->garage->licence_number); ?>/ANAC</p>
                </td>
                <td style="border: 1px solid #ddd;vertical-align: middle;padding:16px" width="15%" align="center">
                    <?php if(isset($order_service->number_form) && !is_null($order_service->number_form)): ?>
                        <p style="font-size: 14px;"><?php echo e($order_service->number_form); ?></p>
                    <?php endif; ?>
                    <?php if(isset($order_service->date_form) && !is_null($order_service->date_form)): ?>
                        <p style="font-size: 14px;"><?php echo e(\Carbon\Carbon::parse($order_service->date_form)->format('d/m/Y')); ?></p>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <table style="margin: 4px 0;width:100%;">
            <tr>
                <td>
                    <h2 style="margin:0px;text-align:center;font-weight:bold;">OS
                        <?php echo e($order_service->code_text); ?>/<?php echo e($order_service->created_at_year); ?></h2>
                </td>
                <td>
                    <h2 style="margin:0px;text-align:center;font-weight:bold;">
                        <?php echo e($order_service->aircraft_registration); ?>

                    </h2>
                </td>
            </tr>
        </table>

        <?php if(!is_null($order_service->aircraft)): ?>
            <table style="border: 1px solid #ddd;width:100%;border-collapse: collapse;">
                <?php $__currentLoopData = $order_service->aircraft; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td>
                            <p style="padding:0;text-align:center;font-size:12px;"><?php echo e($component->component_text); ?></p>
                        </td>
                        <td style="padding:20px;border-left: 1px solid #ddd;">
                            <table style="width:100%;border-collapse: collapse;">
                                <tr>
                                    <td width="20%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">SN:
                                            <?php echo e($component->serial_number); ?></p>
                                    </td>
                                    <td width="20%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">Modelo:
                                            <?php echo e($component->model); ?></p>
                                    </td>
                                    <td width="30%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">Fabricante:
                                            <?php echo e($component->manufacturer); ?></p>
                                    </td>
                                    <td width="30%">
                                        
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">Ano de
                                            Fabricação:
                                            <?php echo e($order_service->year_manufacture); ?></p>
                                        @
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">TSN:
                                            <?php echo $__env->make('pdf.order-service.components.aircraft_component_status', [
                                                'status' => $component->tsn_status,
                                                'value' => $component->tsn,
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </p>
                                    </td>
                                    <td width="20%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">TSO:
                                            <?php echo $__env->make('pdf.order-service.components.aircraft_component_status', [
                                                'status' => $component->tso_status,
                                                'value' => $component->tso,
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </p>
                                    </td>
                                    <td width="30%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">CSN:
                                            <?php echo $__env->make('pdf.order-service.components.aircraft_component_status', [
                                                'status' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->csn_status,
                                                'value' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->csn,
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </p>
                                    </td>
                                    <td width="30%">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">CSO:
                                            <?php echo $__env->make('pdf.order-service.components.aircraft_component_status', [
                                                'status' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->cso_status,
                                                'value' => $component->group === App\Constants::GROUP_PROPELLERS ? null : $component->cso,
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="font-12">
                                    <td style="border: none!important;" colspan="5">
                                        <p style="margin: 0;padding:0;font-size:12px;text-align:left;">
                                            Revisão:
                                            <?php if($component->group === App\Constants::GROUP_PROPELLERS && !$order_service->has_propeller): ?>
                                                N/A
                                            <?php else: ?>
                                                <?php echo e($order_service->revisions->filter(fn($item) => $item->group === $component->group)->values()->reduce(function ($acc, $item, $idx) use ($order_service, $component) {
                                                    $acc .= "Manual:{$item->name} / Revision:{$item->manual} / PN:{$item->pn} ";
                                                    if (
                                                        $idx >= 0 &&
                                                        $idx <
                                                        $order_service->revisions->filter(fn($itemFilter) => $itemFilter->group === $component->group)->values()->count() - 1
                                                    ) {
                                                        $acc .= ' | ';
                                                    }
                                                    return $acc;
                                                }, '')); ?>

                                            <?php endif; ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        <?php endif; ?>

        <table style="border: 1px solid #ddd;width:100%;border-top: none!important;">
            <tr>
                <td style="padding:20px;">
                    <?php if(!is_null($order_service->date_start)): ?>
                        <p style="margin: 0;padding:0;font-size:14px;text-align:center;">
                            Data de Início:
                            <?php echo e(\Carbon\Carbon::parse($order_service->date_start)->format('d/m/Y')); ?>

                        </p>
                    <?php endif; ?>
                </td>
                <td style="padding:20px;">
                    <?php if(!is_null($order_service->date_end)): ?>
                        <p style="margin: 0;padding:0;font-size:14px;text-align:center;">
                            Término Previsto:
                            <?php echo e(\Carbon\Carbon::parse($order_service->date_end)->format('d/m/Y')); ?>

                        </p>
                    <?php endif; ?>
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

        <?php
            $items = $order_service->items->filter(fn ($item) => $item->type === App\Constants::SERVICE)->values();
        ?>


        <table style="border: 1px solid #ddd;width:100%;border-collapse: collapse;">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="padding:10px;border-right: 1px solid #ddd" width="1%">
                        <p style="margin: 0;padding:0;font-size:12px;"><?php echo e($key + 1); ?></p>
                    </td>
                    <td style="padding:10px;">
                        <p style="margin: 0;padding:0;font-size:14px;">
                            <?php echo e($item->description); ?>

                        </p>

                        <p style="margin: 0;padding:0;font-size:12px;">
                            <?php if(isset($item->pn) && !is_null($item->pn)): ?>
                                <span>PN: <?php echo e($item->pn); ?></span>
                            <?php endif; ?>
                            <?php if(isset($item->serial_number) && !is_null($item->serial_number)): ?>
                                <span> | SN: <?php echo e($item->serial_number); ?></span>
                            <?php endif; ?>
                        </p>
                        <p style="margin: 0;padding:0;font-size:12px;">
                                <span>
                                    Intervalo:
                                </span>
                            <span>
                                    <?php echo $__env->make('pdf.order-service.components.maintenance_date', [
                                        'date' => $item->interval_quantity,
                                        'unit_measurement' => $item->interval_unit_measurement,
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </span>
                            <span>
                                    | Horas:
                                    <?php echo $__env->make('pdf.order-service.components.maintenance_hours', [
                                        'hours' => $item->interval_hours,
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </span>
                            <span>
                                    | Ciclos
                                    <?php echo $__env->make('pdf.order-service.components.maintenance_cycles', [
                                        'cycles' => $item->interval_cycles,
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </span>
                        </p>

                        <p style="margin: 0;padding:0;font-size:12px;">
                            Equipe:
                            <?php echo e($item->team_text); ?>

                        </p>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>

        <table style="border: 1px solid #ddd;width:100%;border-collapse:collapse;margin-top:4px;">
            <tr>
                <td style="padding:10px;" align="center">
                    <h4 style="text-align: center;">DECLARAÇÃO DE AERONAVEGABILIDADE</h4> <br/>
                    <?php if(isset($order_service->closed_at) && !is_null($order_service->closed_at)): ?>
                        <span class="text-center" style="font-size:14px;display:block">OS encerrada na data de:
                                <?php echo e(\Carbon\Carbon::parse($order_service->closed_at)->format('d/m/Y')); ?>

                            </span>
                        <br/>
                    <?php endif; ?>

                    <?php if(isset($order_service->type_airworthiness) && !is_null($order_service->type_airworthiness)): ?>
                        <?php if($order_service->type_airworthiness == 'airworthy'): ?>
                            Declaro para os devidos fins que os serviços efetuados através desta Ordem de Serviço foram
                            realizados de acordo com os Dados Técnicos e os Regulamentos aplicáveis e que após a
                            inspeção de
                            qualidade das partes afetadas foram consideradas aprovadas para retorno ao serviço.
                        <?php endif; ?>
                        <?php if($order_service->type_airworthiness == 'airworthy_with_restriction'): ?>
                            Declaro para os devidos fins que os serviços efetuados através desta Ordem de Serviço foram
                            realizados de acordo com os Dados Técnicos e os Regulamentos aplicáveis e que após a
                            inspeção de
                            qualidade das partes afetadas foram consideradas aprovadas para retorno ao serviço, com a
                            ressalva conforme ficha de discrepância
                            <?php if(isset($file_discrepancy_signed) && !is_null($order_service->file_discrepancy_signed)): ?>
                                <a href="<?php echo e($order_service->file_discrepancy_signed); ?>" style="color: #D24614"> (link da
                                    ficha)</a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($order_service->type_airworthiness == 'not_airworthy'): ?>
                            Declaro para os devidos fins que os serviços efetuados através desta Ordem de Serviço foram
                            realizados de acordo com os Dados Técnicos e os Regulamentos aplicáveis e que após a
                            inspeção de
                            qualidade das partes afetadas foram consideradas REPROVADAS para retorno ao serviço.
                            <?php if(isset($order_service->file_discrepancy_signed) && !is_null($order_service->file_discrepancy_signed)): ?>
                                <a href="<?php echo e($order_service->file_discrepancy_signed); ?>" style="color: #D24614"> (link da
                                    ficha)</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <br/>
                    <br/>
                    <br/>
                    <span style="text-align: center;display:block">_________________________________________________________</span>
                    <br/>

                    <p>Assinatura do Inspetor Responsável</p>
                    <p style="font-size: 14px;">
                        <?php if(!is_null($order_service->responsible_user)): ?>
                            <?php echo e($order_service->responsible_user->name); ?>

                            <?php if(!is_null($order_service->responsible_user->license_1)): ?>
                                <?php echo e(' / Licença.:' . $order_service->responsible_user->license_1); ?>

                            <?php endif; ?>
                            <?php if(!is_null($order_service->responsible_user->license_2)): ?>
                                <?php echo e(' / Codigo ANAC Nr.:' . $order_service->responsible_user->license_2); ?>

                            <?php endif; ?>
                        <?php endif; ?>
                    </p>
                    <?php if(!is_null($order_service->local)): ?>
                        <p style="margin: 0"><?php echo e($order_service->local); ?></p>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base_pdf', [
    'title' => 'Order service',
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/pdf/order-service/order_service.blade.php ENDPATH**/ ?>