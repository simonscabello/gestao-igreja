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
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>Nome Completo:</th>
                                        <td>{{ $member->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $member->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telefone Fixo:</th>
                                        <td>{{ $member->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Celular:</th>
                                        <td>{{ $member->cellphone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gênero:</th>
                                        <td>{{ $member->gender?->label() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Estado Civil:</th>
                                        <td>{{ $member->marital_status?->label() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Data de Nascimento:</th>
                                        <td>{{ $member->birth_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Data de Batismo:</th>
                                        <td>{{ $member->baptism_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Data de Admissão:</th>
                                        <td>{{ $member->admission_date }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <form id="deleteMember" action="{{ route('member.destroy', $member) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remover</button>
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
