@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Categoria: {{ $financialCategory->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Início</a></li>
                            <li class="breadcrumb-item"><a href="#">Categorias</a></li>
                            <li class="breadcrumb-item active">Editar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Editar categoria</h3>
                            </div>

                            <form action="{{ route('categoryFinancial.update', $financialCategory) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="form-group" style="max-width: 500px;">
                                        <label for="name">Nome*</label>
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $financialCategory->name }}"
                                            readonly
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
                                            value="{{ old('description') ?? $financialCategory->description }}"
                                            placeholder="Insira a descrição"
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
                                            <option value="1" {{ $financialCategory->active ? 'selected' : '' }}>Sim</option>
                                            <option value="0" {{ !$financialCategory->active ? 'selected' : '' }}>Não</option>
                                        </select>
                                        @error('active')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Atualizar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection

