<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrdemServicoController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function index()
    {
        $ordensServico = OrdemServico::with(['componentes', 'itensServico'])->get();
        return view('ordem-servico.index', compact('ordensServico'));
    }

    public function show($id)
    {
        $ordemServico = OrdemServico::with(['componentes', 'itensServico'])->findOrFail($id);
        return view('ordem-servico.show', compact('ordemServico'));
    }

    public function generatePdf($id)
    {
        $ordemServico = OrdemServico::with(['componentes', 'itensServico'])->findOrFail($id);

        $pdf = $this->pdfService->generateOrdemServicoPdf($ordemServico);

        return response($pdf, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="OS_' . $ordemServico->numero_os . '.pdf"');
    }

    public function downloadPdf($id)
    {
        $ordemServico = OrdemServico::with(['componentes', 'itensServico'])->findOrFail($id);

        $pdf = $this->pdfService->generateOrdemServicoPdf($ordemServico);

        return response($pdf, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="OS_' . $ordemServico->numero_os . '.pdf"');
    }

    public function create()
    {
        return view('ordem-servico.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_os' => 'required|string|unique:ordem_servicos',
            'aeronave_matricula' => 'required|string',
            'data_inicio' => 'required|date',
            'termino_previsto' => 'required|date|after_or_equal:data_inicio',
        ]);

        $ordemServico = OrdemServico::create($request->all());

        return redirect()->route('ordem-servico.show', $ordemServico->id)
            ->with('success', 'Ordem de Serviço criada com sucesso!');
    }

    public function edit($id)
    {
        $ordemServico = OrdemServico::with(['componentes', 'itensServico'])->findOrFail($id);
        return view('ordem-servico.edit', compact('ordemServico'));
    }

    public function update(Request $request, $id)
    {
        $ordemServico = OrdemServico::findOrFail($id);

        $request->validate([
            'numero_os' => 'required|string|unique:ordem_servicos,numero_os,' . $id,
            'aeronave_matricula' => 'required|string',
            'data_inicio' => 'required|date',
            'termino_previsto' => 'required|date|after_or_equal:data_inicio',
        ]);

        $ordemServico->update($request->all());

        return redirect()->route('ordem-servico.show', $ordemServico->id)
            ->with('success', 'Ordem de Serviço atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $ordemServico = OrdemServico::findOrFail($id);
        $ordemServico->delete();

        return redirect()->route('ordem-servico.index')
            ->with('success', 'Ordem de Serviço excluída com sucesso!');
    }
}

