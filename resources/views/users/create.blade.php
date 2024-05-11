@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1>Adicionar Usuário</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Início</a></li>
                            <li class="breadcrumb-item"><a href="#">Usuários</a></li>
                            <li class="breadcrumb-item active">Adicionar</li>
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
                                <h3 class="card-title">Novo usuário</h3>
                            </div>

                            <form action="{{route('admin.store')}}" method="POST">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group col-6">
                                        <label for="email">Email </label>
                                        <input
                                            type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email"
                                            placeholder="Insira o email"
                                            value="{{ old('email') }}"
                                        >
                                        @error('email')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                        @enderror
                                        <small class="form-text text-muted">
                                            O novo usuário receberá um email com as instruções para definir a senha.
                                        </small>
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

@section('scripts')
    <script src="{{ asset('js/members/address_fields.js') }}"></script>
@endsection
