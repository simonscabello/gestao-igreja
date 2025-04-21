@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>Detalhes da Transação</h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Transação: {{ $transaction->description ?? 'Sem descrição' }}</h5>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6"><strong>Categoria:</strong><br> {{ $transaction->category->name }}</div>
                            <div class="col-md-6"><strong>Tipo:</strong><br> {{ $transaction->type->label() }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6"><strong>Valor:</strong><br> R$ {{ number_format($transaction->amount, 2, ',', '.') }}</div>
                            <div class="col-md-6"><strong>Data da Ação:</strong><br> {{ $transaction->action_date->format('d/m/Y') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6"><strong>Descrição:</strong><br> {{ $transaction->description ?? '-' }}</div>
                            <div class="col-md-6"><strong>Registrado por:</strong><br> {{ $transaction->createdBy->name }}</div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                        <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

