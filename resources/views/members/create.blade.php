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

                <form action="{{route('member.store')}}" method="POST">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">Nome Completo*</label>
                            <input type="text" class="form-control is-invalid" name="name" placeholder="Insira o nome completo">
                            <span class="error invalid-feedback">Please enter a email address</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email </label>
                            <input type="email" class="form-control" name="email" placeholder="Insira o email">
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone_number">Telefone Fixo</label>
                                    <input name="phone_number" type="tel" class="form-control" placeholder="Insira o telefone fixo">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cellphone">Celular</label>
                                    <input name="cellphone" type="tel" class="form-control " placeholder="Insira o celular">
                                </div>
                            </div>
                        </div>

                           <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gênero*</label>
                                    <select class="form-control select2" name="gender" >
                                        <option disabled="true" selected>---</option>
                                         @foreach ( $genders as  $gender)
                                            <option value="{{$gender->value}}">
                                                {{ $gender->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estado Civil</label>
                                    <select class="form-control select2" name="marital_status">
                                        <option disabled="true" selected>---</option>
                                         @foreach ( $maritalStatuses as  $maritalStatus)
                                            <option value="{{$maritalStatus->value}}">
                                                {{ $maritalStatus->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="birth_date">Data de Nascimento*</label>
                                    <input name="birth_date" type="date" class="form-control"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="baptism_date">Data de Batismo</label>
                                    <input name="baptism_date" type="date" class="form-control"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="admission_date">Data de Admissão</label>
                                    <input name="admission_date" type="text" class="form-control"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
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
