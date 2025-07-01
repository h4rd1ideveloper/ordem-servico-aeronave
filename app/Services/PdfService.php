<?php

namespace App\Services;

use App\DTO\OrderService;
use App\Models\OrdemServico;
use Illuminate\Support\Facades\View;

class PdfService
{
    public function generateOrdemServicoPdf(OrdemServico $ordemServico)
    {
        // Renderizar o HTML usando Blade
        $html = View::make('pdf.ordem-servico', compact('ordemServico'))->render();

        // Criar arquivo HTML temporário
        $tempHtmlFile = storage_path('app/temp_os_' . $ordemServico->id . '.html');
        file_put_contents($tempHtmlFile, $html);

        // Criar arquivo PDF temporário
        $tempPdfFile = storage_path('app/temp_os_' . $ordemServico->id . '.pdf');

        // Comando wkhtmltopdf (usar wrapper no Docker se disponível)
        $wkhtmltopdfCmd = env('WKHTMLTOPDF_CMD', 'wkhtmltopdf');
        $command = sprintf(
            '%s --page-size A4 --margin-top 10mm --margin-bottom 10mm --margin-left 10mm --margin-right 10mm --encoding UTF-8 --disable-smart-shrinking --print-media-type --dpi 300 --enable-local-file-access %s %s',
            $wkhtmltopdfCmd,
            escapeshellarg($tempHtmlFile),
            escapeshellarg($tempPdfFile)
        );

        // Executar comando
        $output = [];
        $returnCode = 0;
        exec($command . ' 2>&1', $output, $returnCode);

        if ($returnCode !== 0) {
            // Limpar arquivos temporários
            if (file_exists($tempHtmlFile)) unlink($tempHtmlFile);
            if (file_exists($tempPdfFile)) unlink($tempPdfFile);

            throw new \Exception('Erro ao gerar PDF: ' . implode("\n", $output));
        }

        // Ler conteúdo do PDF
        $pdfContent = file_get_contents($tempPdfFile);

        // Limpar arquivos temporários
        if (file_exists($tempHtmlFile)) unlink($tempHtmlFile);
        if (file_exists($tempPdfFile)) unlink($tempPdfFile);

        return $pdfContent;
    }
    public function generateOrderServicePdf(OrderService $ordemServico)
    {
        // Renderizar o HTML usando Blade
        $html = View::make('pdf.order-service.order_service', compact('ordemServico'))->render();

        // Criar arquivo HTML temporário
        $tempHtmlFile = storage_path('app/temp_os_' . $ordemServico->id . '.html');
        file_put_contents($tempHtmlFile, $html);

        // Criar arquivo PDF temporário
        $tempPdfFile = storage_path('app/temp_os_' . $ordemServico->id . '.pdf');

        // Comando wkhtmltopdf (usar wrapper no Docker se disponível)
        $wkhtmltopdfCmd = env('WKHTMLTOPDF_CMD', 'wkhtmltopdf');
        $command = sprintf(
            '%s --page-size A4 --margin-top 10mm --margin-bottom 10mm --margin-left 10mm --margin-right 10mm --encoding UTF-8 --disable-smart-shrinking --print-media-type --dpi 300 --enable-local-file-access %s %s',
            $wkhtmltopdfCmd,
            escapeshellarg($tempHtmlFile),
            escapeshellarg($tempPdfFile)
        );

        // Executar comando
        $output = [];
        $returnCode = 0;
        exec($command . ' 2>&1', $output, $returnCode);

        if ($returnCode !== 0) {
            // Limpar arquivos temporários
            if (file_exists($tempHtmlFile)) unlink($tempHtmlFile);
            if (file_exists($tempPdfFile)) unlink($tempPdfFile);

            throw new \Exception('Erro ao gerar PDF: ' . implode("\n", $output));
        }

        // Ler conteúdo do PDF
        $pdfContent = file_get_contents($tempPdfFile);

        // Limpar arquivos temporários
        if (file_exists($tempHtmlFile)) unlink($tempHtmlFile);
        if (file_exists($tempPdfFile)) unlink($tempPdfFile);

        return $pdfContent;
    }

    public function generateOrdemServicoPdfWithPageBreaks(OrdemServico $ordemServico)
    {
        // Calcular quebras de página baseado no número de itens
        $itensPerPage = $this->calculateItemsPerPage($ordemServico);
        $chunks = $ordemServico->itensServico->chunk($itensPerPage);

        $pages = [];
        $isFirstPage = true;

        foreach ($chunks as $pageIndex => $itensChunk) {
            $pageData = [
                'ordemServico' => $ordemServico,
                'itensServico' => $itensChunk,
                'isFirstPage' => $isFirstPage,
                'pageNumber' => $pageIndex + 1,
                'totalPages' => $chunks->count()
            ];

            $pages[] = View::make('pdf.ordem-servico-page', $pageData)->render();
            $isFirstPage = false;
        }

        // Configurar wkhtmltopdf
        $pdf = new Pdf([
            'no-outline',
            'page-size' => 'A4',
            'margin-top' => '10mm',
            'margin-bottom' => '10mm',
            'margin-left' => '10mm',
            'margin-right' => '10mm',
            'encoding' => 'UTF-8',
            'disable-smart-shrinking',
            'print-media-type',
            'dpi' => 300,
            'image-quality' => 100,
            'enable-local-file-access',
        ]);

        // Adicionar cada página
        foreach ($pages as $pageHtml) {
            $pdf->addPage($pageHtml);
        }

        if (!$pdf->send()) {
            throw new \Exception('Erro ao gerar PDF: ' . $pdf->getError());
        }

        return $pdf->toString();
    }

    private function calculateItemsPerPage(OrdemServico $ordemServico)
    {
        // Altura disponível aproximada em uma página A4 (considerando margens e cabeçalho)
        $availableHeight = 250; // mm aproximadamente

        // Altura estimada do cabeçalho na primeira página
        $headerHeight = 80; // mm

        // Altura estimada de cada item de serviço
        $itemHeight = 15; // mm (pode variar baseado no conteúdo)

        // Altura da seção de declaração
        $declarationHeight = 30; // mm

        // Calcular itens que cabem na primeira página
        $firstPageAvailableHeight = $availableHeight - $headerHeight - $declarationHeight;
        $itemsFirstPage = floor($firstPageAvailableHeight / $itemHeight);

        // Para páginas subsequentes (sem cabeçalho completo)
        $subsequentPageHeight = $availableHeight - 20; // margem para continuação
        $itemsSubsequentPage = floor($subsequentPageHeight / $itemHeight);

        return max($itemsFirstPage, 8); // Mínimo de 8 itens por página
    }

    public function previewOrdemServicoHtml(OrdemServico $ordemServico)
    {
        return View::make('pdf.ordem-servico', compact('ordemServico'))->render();
    }
}

