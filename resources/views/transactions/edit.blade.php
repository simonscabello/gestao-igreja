@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1>Editar Transação</h1>
                <a href="{{ route('transaction.index') }}" class="btn btn-secondary btn-sm">Voltar</a>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Editar Transação</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group" style="max-width: 400px;">
                                <label for="financial_category_id">Categoria*</label>
                                <select name="financial_category_id" class="form-control @error('financial_category_id') is-invalid @enderror">
                                    @foreach($financialCategories as $category)
                                        <option value="{{ $category->id }}" {{ $transaction->financial_category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('financial_category_id')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" style="max-width: 250px;">
                                <label for="type">Tipo*</label>
                                <select name="type" class="form-control @error('type') is-invalid @enderror">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->value }}" {{ $transaction->type->value === $type->value ? 'selected' : '' }}>
                                            {{ $type->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" style="max-width: 250px;">
                                <label for="amount">Valor*</label>
                                <input type="number" step="0.01" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ $transaction->amount }}">
                                @error('amount')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" style="max-width: 250px;">
                                <label for="action_date">Data da Ação*</label>
                                <input type="date" name="action_date" class="form-control @error('action_date') is-invalid @enderror" value="{{ $transaction->action_date->format('Y-m-d') }}">
                                @error('action_date')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" style="max-width: 600px;">
                                <label for="description">Descrição</label>
                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ $transaction->description }}">
                                @error('description')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
