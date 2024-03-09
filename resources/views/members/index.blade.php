@extends('layouts.app')
@section('content')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Gestão de Membros</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Início</a></li>
                <li class="breadcrumb-item active">Membros</li>
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
            <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Membros
                </h3>

                <div class="card-tools">
                    <a href="{{ route('member.create')}}" class="btn btn-inline-block btn-primary btn-sm">
                        <i class="fas fa-plus mr-1"></i> Cadastrar Membro</a>
                </div>

            </div>

            <!-- /.card-body -->
              <div class="card-body">
                <table class="datatable table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Gênero</th>
                    <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td> {{ $member->name}} </td>
                            <td> {{ $member->birth_date->format('d/m/Y')}} </td>
                            <td> {{ $member->gender->label()}}</td>
                            <td>  <a href="{{route('member.edit', $member)}}" class="btn btn-inline-block btn-primary btn-sm">
                                <i class="fas fa-pen mr-1"></i>
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
