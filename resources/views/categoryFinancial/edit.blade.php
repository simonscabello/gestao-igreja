@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Editar categoria</h3>
                            </div>

                            <form action="{{route('categoryFinancial.update', $financialCategory)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Nome*</label>
                                        <input
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            name="name"
                                            placeholder="Insira o nome"
                                            value="{{ $financialCategory->name }}"
                                            readonly
                                        >
                                        @error('name')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="name">Descrição</label>
                                        <input
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            name="description"
                                            placeholder="Insira a descrição"
                                            value="{{ old('description') }}"
                                        >
                                        @error('description')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Ativo*</label>

                                        <select
                                            class="form-control select2 @error('active') is-invalid @enderror "
                                            name="active">
                                                <option value="1" selected>Sim</option>
                                                <option value="0">Não</option>
                                            
                                        </select>
                                        @error('active')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                        @enderror
                                    </div>
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

