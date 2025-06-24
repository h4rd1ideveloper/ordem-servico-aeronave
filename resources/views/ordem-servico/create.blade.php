@extends('layouts.app')

@section('title', 'Nova Ordem de Serviço')

@section('content')
    <div class="container">
        <h1>Nova Ordem de Serviço</h1>

        <form action="{{ route('ordem-servico.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero_os">Número da OS</label>
                        <input type="text" class="form-control" id="numero_os" name="numero_os" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aeronave_matricula">Matrícula da Aeronave</label>
                        <input type="text" class="form-control" id="aeronave_matricula" name="aeronave_matricula" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="data_inicio">Data de Início</label>
                        <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="termino_previsto">Término Previsto</label>
                        <input type="date" class="form-control" id="termino_previsto" name="termino_previsto" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="empresa_nome">Nome da Empresa</label>
                        <input type="text" class="form-control" id="empresa_nome" name="empresa_nome" value="MTX Aviation Manutenção De Aeronaves Ltda" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="empresa_endereco">Endereço da Empresa</label>
                        <input type="text" class="form-control" id="empresa_endereco" name="empresa_endereco" value="Sorocaba/SP - CUM 20130641/ANAC" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="documento_codigo">Código do Documento</label>
                        <input type="text" class="form-control" id="documento_codigo" name="documento_codigo" value="F-TEC 015 REV03" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Criar Ordem de Serviço</button>
                <a href="{{ route('ordem-servico.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection

