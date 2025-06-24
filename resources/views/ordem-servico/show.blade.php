@extends('layouts.app')

@section('title', 'Ordem de Serviço #' . $ordemServico->numero_os)

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Ordem de Serviço #{{ $ordemServico->numero_os }}</h1>
            <div>
               {{-- <a href="{{ route('ordem-servico.edit', $ordemServico->id) }}" class="btn btn-warning">Editar</a>--}}
                <a href="{{ route('ordem-servico.pdf', $ordemServico->id) }}" class="btn btn-danger" target="_blank">Gerar
                    PDF</a>
                <a href="{{ route('ordem-servico.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Informações Gerais</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Número da OS:</strong> {{ $ordemServico->numero_os }}</p>
                        <p><strong>Matrícula da Aeronave:</strong> {{ $ordemServico->aeronave_matricula }}</p>
                        <p><strong>Data de Início:</strong> {{ $ordemServico->data_inicio->format('d/m/Y') }}</p>
                        <p><strong>Término Previsto:</strong> {{ $ordemServico->termino_previsto->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Empresa:</strong> {{ $ordemServico->empresa_nome }}</p>
                        <p><strong>Endereço:</strong> {{ $ordemServico->empresa_endereco }}</p>
                        <p><strong>Documento:</strong> {{ $ordemServico->documento_codigo }}</p>
                        <p><strong>Data do Documento:</strong> {{ $ordemServico->documento_data->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Componentes da Aeronave</h5>
            </div>
            <div class="card-body">
                @if($ordemServico->componentes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Serial Number</th>
                                <th>TSN</th>
                                <th>Modelo</th>
                                <th>TSO</th>
                                <th>Fabricante</th>
                                <th>CSO</th>
                                <th>Ano Fabricação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ordemServico->componentes as $componente)
                                <tr>
                                    <td><strong>{{ $componente->tipo }}</strong></td>
                                    <td>{{ $componente->serial_number ?? 'N/A' }}</td>
                                    <td>{{ $componente->tsn ?? 'N/A' }}</td>
                                    <td>{{ $componente->modelo ?? 'N/A' }}</td>
                                    <td>{{ $componente->tso ?? 'N/A' }}</td>
                                    <td>{{ $componente->fabricante ?? 'N/A' }}</td>
                                    <td>{{ $componente->cso ?? 'N/A' }}</td>
                                    <td>{{ $componente->ano_fabricacao ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Nenhum componente cadastrado.</p>
                @endif
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Itens de Serviço Executados</h5>
            </div>
            <div class="card-body">
                @if($ordemServico->itensServico->count() > 0)
                    @foreach($ordemServico->itensServico as $item)
                        <div class="border p-3 mb-3">
                            <div class="row">
                                <div class="col-md-1">
                                    <strong>{{ $item->numero_item }}</strong>
                                </div>
                                <div class="col-md-11">
                                    <h6>{{ $item->descricao }}</h6>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <small><strong>Equipe:</strong> {{ $item->equipe ?? 'N/A' }}</small>
                                        </div>
                                        <div class="col-md-3">
                                            <small><strong>Intervalo:</strong> {{ $item->intervalo ?? 'N/A' }}</small>
                                        </div>
                                        <div class="col-md-3">
                                            <small><strong>Horas:</strong> {{ $item->horas ?? 'N/A' }}</small>
                                        </div>
                                        <div class="col-md-3">
                                            <small><strong>Ciclos:</strong> {{ $item->ciclos ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                    @if($item->observacoes)
                                        <div class="mt-2">
                                            <small><strong>Observações:</strong> {{ $item->observacoes }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Nenhum item de serviço cadastrado.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

