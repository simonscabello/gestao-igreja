@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1>Visualizar Categoria</h1>
                    </div>


                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Início</a></li>
                            <li class="breadcrumb-item"><a href="#">Categorias</a></li>
                            <li class="breadcrumb-item active">Visualizar</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Visualizar categoria: {{ $financialCategory->name }}</h3>


                                <div class="card-tools">
                                    <a href="{{ route('categoryFinancial.edit', $financialCategory->id)}}" class="btn btn-inline-block btn-primary btn-sm">
                                        <i class="fas fa-edit mr-1"></i> Editar Categoria</a>
                                </div>
                            </div>

                            
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        value="{{ $financialCategory->name }}"
                                        readonly
                                    >
                                    
                                </div>


                                <div class="form-group">
                                    <label for="name">Descrição</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        value="{{ $financialCategory->description ?? '' }}"
                                        readonly
                                    >
                                </div>


                                <div class="form-group">
                                    <label>Ativo</label>

                                    <input 
                                        type="text"
                                        value="@if ($financialCategory->active) Ativo @else Inativo @endif"
                                        class="form-control"
                                        readonly
                                    >
                                    </input>
                                
                                </div>
                            </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

