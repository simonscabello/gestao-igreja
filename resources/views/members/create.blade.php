@extends('layouts.app')
@section('content')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Adicionar Membro</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Início</a></li>
                <li class="breadcrumb-item"><a href="#">Membros</a></li>
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
                    <h3 class="card-title">Novo membro</h3>
                </div>

                <form>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="inputName">Nome Completo*</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Insira o nome completo">
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Email </label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Insira o email">
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Telefone Fixo</label>
                                    <input id="" type="number" class="form-control" placeholder="Insira o telefone fixo">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <input id="" type="number" class="form-control" placeholder="Insira o celular">
                                </div>
                            </div>
                        </div>

                           <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gênero*</label>
                                    <select class="form-control">
                                        <option></option>
                                        <option>Feminino</option>
                                        <option>Masculino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estado Civil</label>
                                    <select class="form-control">
                                        <option></option>
                                        <option>Solteiro</option>
                                        <option>Casado</option>
                                        <option>Divorciado</option>
                                        <option>Viúvo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Data de Nascimento*</label>
                                    <input id="" type="date" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Data de Batismo</label>
                                    <input id="" type="date" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Data de Admissão</label>
                                    <input id="" type="date" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Data de Saída</label>
                                    <input id="" type="date" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>

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
