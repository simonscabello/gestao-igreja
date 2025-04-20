@extends('layouts.app')
@section('content')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Transações Financeiras</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Início</a></li>
                <li class="breadcrumb-item active">Transações Financeiras</li>
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
                    Transações
                </h3>

                <div class="card-tools">
                    <a href="{{ route('member.create')}}" class="btn btn-inline-block btn-primary btn-sm">
                        <i class="fas fa-plus mr-1"></i> Adicionar</a>
                </div>

            </div>

            <!-- /.card-body -->
              <div class="card-body">
                <table class="datatable table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Valor</th>
                    <th>Categoria</th>
                    <th>Cadastrado por</th>
                    <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td> {{ $transaction->amount }} </td>
                            <td> {{ $transaction->category->name }} </td>
                            <td> {{ $transaction->created_by}} </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Ações">
                                    <a href="{{ route('transaction.edit', $transaction) }}" class="btn btn-primary btn-sm mr-1" role="button">
                                            <i class="fas fa-pen"></i> Editar
                                    </a>
                                    <a href="{{ route('transaction.show', $transaction) }}" class="btn btn-info btn-sm" role="button">
                                        <i class="fas fa-eye"></i> Visualizar
                                    </a>
                                </div>
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
