@extends('layouts.app')

@section('title', 'Ordens de Serviço')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-clipboard-list"></i> Ordens de Serviço</h1>
    <a href="{{ route('ordem-servico.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nova OS
    </a>
</div>

@if($ordensServico->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>OS #</th>
                            <th>Aeronave</th>
                            <th>Data Início</th>
                            <th>Término Previsto</th>
                            <th>Itens</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ordensServico as $os)
                        <tr>
                            <td><strong>{{ $os->numero_os }}</strong></td>
                            <td>{{ $os->aeronave_matricula }}</td>
                            <td>{{ $os->data_inicio->format('d/m/Y') }}</td>
                            <td>{{ $os->termino_previsto->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-info">{{ $os->itensServico->count() }} itens</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('ordem-servico.show', $os->id) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('ordem-servico.edit', $os->id) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('ordem-servico.pdf', $os->id) }}" 
                                       class="btn btn-sm btn-outline-success" title="Gerar PDF" target="_blank">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <a href="{{ route('ordem-servico.download', $os->id) }}" 
                                       class="btn btn-sm btn-outline-info" title="Download PDF">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body text-center">
            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
            <h4>Nenhuma Ordem de Serviço encontrada</h4>
            <p class="text-muted">Comece criando sua primeira Ordem de Serviço.</p>
            <a href="{{ route('ordem-servico.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Criar primeira OS
            </a>
        </div>
    </div>
@endif
@endsection

