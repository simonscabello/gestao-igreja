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
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                placeholder="Insira o nome completo"
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <span class="error invalid-feedback"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group">
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
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone_number">Telefone Fixo</label>
                                    <input
                                        name="phone_number"
                                        type="tel"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        placeholder="Insira o telefone fixo"
                                        value="{{ old('phone_number') }}"
                                    >
                                    @error('phone_number')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cellphone">Celular</label>
                                    <input
                                        name="cellphone"
                                        type="tel"
                                        class="form-control @error('cellphone') is-invalid @enderror"
                                        placeholder="Insira o celular"
                                    >
                                    @error('cellphone')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                           <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gênero*</label>

                                    <select class="form-control select2 @error('gender') is-invalid @enderror "
                                        name="gender" >
                                        <option disabled selected>---</option>
                                         @foreach ( $genders as  $gender)
                                            <option value="{{$gender->value}}">
                                                {{ $gender->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estado Civil</label>
                                    <select class="form-control select2 @error('marital_status') is-invalid @enderror"
                                    name="marital_status">
                                        <option disabled selected>---</option>
                                         @foreach ( $maritalStatuses as  $maritalStatus)
                                            <option value="{{$maritalStatus->value}}">
                                                {{ $maritalStatus->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('marital_status')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="birth_date">Data de Nascimento*</label>
                                    <input
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask
                                        name="birth_date"
                                        type="text"
                                        class="form-control @error('birth_date') is-invalid @enderror"
                                        placeholder=""
                                        value="{{ old('birth_date') }}"
                                    >
                                    @error('birth_date')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="baptism_date">Data de Batismo</label>
                                    <input
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask
                                        name="baptism_date"
                                        type="text"
                                        class="form-control @error('baptism_date') is-invalid @enderror"
                                        placeholder=""
                                        value="{{ old('baptism_date') }}"
                                    >
                                    @error('baptism_date')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="admission_date">Data de Admissão</label>
                                    <input
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask
                                        name="admission_date"
                                        type="text"
                                        class="form-control @error('admission_date') is-invalid @enderror"
                                        placeholder=""
                                        value="{{ old('admission_date') }}"
                                    >
                                    @error('admission_date')
                                        <span class="error invalid-feedback"> {{ $message }} </span>
                                    @enderror
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
