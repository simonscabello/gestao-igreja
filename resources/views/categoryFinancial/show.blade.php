@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detalhes da Categoria</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Início</a></li>
                            <li class="breadcrumb-item"><a href="#">Categorias</a></li>
                            <li class="breadcrumb-item active">Visualizar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Detalhes da Categoria</h5>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Nome:</strong><br>
                                {{ $financialCategory->name }}
                            </div>
                            <div class="col-md-4">
                                <strong>Descrição:</strong><br>
                                {{ $financialCategory->description ?? '-' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Status:</strong><br>
                                {{ $financialCategory->active ? 'Ativo' : 'Inativo' }}
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('categoryFinancial.edit', $financialCategory->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

