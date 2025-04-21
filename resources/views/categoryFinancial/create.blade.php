@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Adicionar Categoria</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Início</a></li>
                            <li class="breadcrumb-item"><a href="#">Categorias</a></li>
                            <li class="breadcrumb-item active">Adicionar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Nova categoria</h3>
                            </div>

                            <form action="{{ route('categoryFinancial.store') }}" method="POST">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group" style="max-width: 500px;">
                                        <label for="name">Nome*</label>
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Insira o nome"
                                            value="{{ old('name') }}"
                                        >
                                        @error('name')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group" style="max-width: 500px;">
                                        <label for="description">Descrição</label>
                                        <input
                                            type="text"
                                            id="description"
                                            name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Insira a descrição"
                                            value="{{ old('description') }}"
                                        >
                                        @error('description')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group" style="max-width: 300px;">
                                        <label for="active">Ativo*</label>
                                        <select
                                            id="active"
                                            name="active"
                                            class="form-control select2 @error('active') is-invalid @enderror">
                                            <option value="1" {{ old('active', 1) == 1 ? 'selected' : '' }}>Sim</option>
                                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Não</option>
                                        </select>
                                        @error('active')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Adicionar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
