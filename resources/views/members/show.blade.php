@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detalhes do Membro</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Início</a></li>
                            <li class="breadcrumb-item"><a href="#">Membros</a></li>
                            <li class="breadcrumb-item active">Detalhes</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Detalhes do Membro</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <strong>Nome Completo:</strong>
                                        <p>{{ $member->name }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Email:</strong>
                                        <p>{{ $member->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <strong>Telefone Fixo:</strong>
                                        <p>{{ $member->phone_number }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Celular:</strong>
                                        <p>{{ $member->cellphone }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <strong>Gênero:</strong>
                                        <p>{{ $member->gender?->label() }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Estado Civil:</strong>
                                        <p>{{ $member->marital_status?->label() }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <strong>Data de Nascimento:</strong>
                                        <p>{{ $member->birth_date }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Data de Batismo:</strong>
                                        <p>{{ $member->baptism_date }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Data de Admissão:</strong>
                                        <p>{{ $member->admission_date }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <strong>CEP:</strong>
                                        <p>{{ $member->address?->zipcode }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Rua:</strong>
                                        <p>{{ $member->address?->street }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Bairro:</strong>
                                        <p>{{ $member->address?->neighborhood }}</p>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-sm-3">
                                        <strong>Cidade:</strong>
                                        <p>{{ $member->address?->city }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Estado:</strong>
                                        <p>{{ $member->address?->state }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <strong>Número:</strong>
                                        <p>{{ $member->address?->number }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong>Complemento:</strong>
                                        <p>{{ $member->address?->complement }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex" >
                                <a href="{{ route('member.edit', $member) }}" class="btn btn-primary mr-2">
                                    <i class="fas fa-edit"></i>
                                    Editar
                                </a>
                                <form id="deleteMember" action="{{ route('member.destroy', $member) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                        Remover
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#deleteMember').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você realmente deseja excluir este membro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).unbind('submit').submit();
                    }
                });
            });
        });
    </script>
@endsection
