<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdemServicoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('ordem-servico.index');
});
Route::get('order-service', [OrdemServicoController::class, 'generateOrderServicePdf'])
    ->name('order-service.generate');

// Rotas para Ordem de Serviço
Route::resource('ordem-servico', OrdemServicoController::class);

// Rotas específicas para PDF
Route::get('ordem-servico/{id}/pdf', [OrdemServicoController::class, 'generatePdf'])
    ->name('ordem-servico.pdf');

Route::get('ordem-servico/{id}/download', [OrdemServicoController::class, 'downloadPdf'])
    ->name('ordem-servico.download');

// Rota para preview HTML (para debug)
Route::get('ordem-servico/{id}/preview', function($id) {
    $ordemServico = \App\Models\OrdemServico::with(['componentes', 'itensServico'])->findOrFail($id);
    return view('pdf.ordem-servico', compact('ordemServico'));
})->name('ordem-servico.preview');

