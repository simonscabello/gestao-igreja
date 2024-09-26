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
                                    <label for="cellphone">Celular*</label>
                                    <input
                                        name="cellphone"
                                        type="tel"
                                        class="form-control @error('cellphone') is-invalid @enderror"
                                        placeholder="Insira o celular"
                                        value="{{ old('cellphone') }}"
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
                                            <option value="{{$gender}}" @if( old('gender') == $gender) selected @endif>
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
                                         @foreach ( $maritalStatuses as $maritalStatus)
                                            <option value="{{$maritalStatus}}" @if( old('marital_status') == $maritalStatus) selected @endif>
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
                            <div class="col-sm-3">
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

                            <div class="col-sm-3">
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

                            <div class="col-sm-3">
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

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="admission_date">Data de Casamento</label>
                                    <input
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask
                                        name="wedding_date"
                                        type="text"
                                        class="form-control @error('wedding_date') is-invalid @enderror"
                                        placeholder=""
                                        value="{{ old('wedding_date') }}"
                                    >
                                    @error('wedding_date')
                                    <span class="error invalid-feedback"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <label for="zipcode">CEP*</label>
                                    <input id="zipcode" type="text" name="zipcode" value=" {{ old('zipcode') }}" class="form-control @error('zipcode') is-invalid @enderror">
                                </div>
                                @error('zipcode')
                                <span class="error invalid-feedback"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="street">Rua</label>
                                    <input id="street" type="text" name="street" value=" {{ old('street') }}" class="form-control @error('street') is-invalid @enderror">
                                </div>
                                @error('street')
                                    <span class="error invalid-feedback"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="neighborhood">Bairro</label>
                                    <input id="neighborhood" type="text" name="neighborhood" value=" {{ old('neighborhood') }}" class="form-control @error('neighborhood') is-invalid @enderror">
                                </div>
                                @error('neighborhood')
                                <span class="error invalid-feedback"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="city">Cidade</label>
                                    <input id="city" type="text" name="city" value=" {{ old('city') }}" class="form-control @error('city') is-invalid @enderror">
                                </div>
                                @error('city')
                                <span class="error invalid-feedback"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="state">Estado</label>
                                    <input id="state" type="text" name="state" value=" {{ old('state') }}" class="form-control @error('state') is-invalid @enderror">
                                </div>
                                @error('state')
                                <span class="error invalid-feedback"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="number">Número</label>
                                    <input id="number" type="text" name="number" value=" {{ old('number') }}" class="form-control @error('number') is-invalid @enderror">
                                </div>
                                @error('number')
                                <span class="error invalid-feedback"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="complement">Complemento</label>
                                    <input id="complement" type="text" name="complement" value=" {{ old('complement') }}" class="form-control @error('complement') is-invalid @enderror">
                                </div>
                                @error('complement')
                                <span class="error invalid-feedback"> {{ $message }} </span>
                                @enderror
                            </div>
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
