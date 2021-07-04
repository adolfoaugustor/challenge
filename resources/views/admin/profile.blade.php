@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Perfil') }}</h1>

    @if ( $message = Session::get('sucess'))
        <div class="alert alert-sucess alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong> {{ $message }} </strong>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-4">
                <div class="card-profile-image mt-4">
                    <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px; left: 35%;" data-initial="{{ Auth::user()->name[0] }}"></figure>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{  Auth::user()->name }} {{  Auth::user()->surname }}</h5>
                                @if ($account->id != null)
                                <table width="100%">
                                    <tbody>                            
                                        <tr>
                                            <th>{{ $account->type_account == 'person' ? "Nome":"Razão Social" }}</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $account->social_reason}}</td>
                                        </tr>

                                        @if ($account->type_account != 'person')
                                        <tr>
                                            <th>Nome Fantasia</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $account->fantasy_name}}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <th>{{ $account->type_account == 'person' ? "CPF":"CNPJ" }}</th>
                                        </tr>
                                        <tr>
                                            <td>{{ Auth::user()->cpf_cnpj }}</td>
                                        </tr>
                                        <tr>
                                            <th>Agência</th>
                                        </tr>
                                        <tr>
                                            <td>000{{ $account->agency }}</td>
                                        </tr>
                                        <tr>
                                            <th>Conta</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $account->number }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @else
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <h1 class="h3 mb-4 text-gray-800">Clique no botão para criar sua conta!</h5>
                                        <a href="{{ route('account.register') }}" class="btn btn-success btn-lg">Abrir Conta</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-8 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Minha conta</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">Informações do usuário</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nome<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ old('name', Auth::user()->name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="surname">Sobrenome</label>
                                        <input type="text" id="surname" class="form-control" name="surname" placeholder="Last name" value="{{ old('surname', Auth::user()->surname) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="cellphone">Celular</label>
                                        <input type="text" id="cellphone" class="form-control" name="cellphone" placeholder="Last name" value="{{ old('cellphone', Auth::user()->cellphone) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">E-mail<span class="small text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="cpf_cnpj">CPF / CNPJ</label>
                                        <input type="text" id="cpf_cnpj" class="form-control" name="cpf_cnpj" disabled placeholder="Last name" value="{{ old('cpf_cnpj', Auth::user()->cpf_cnpj) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Senha atual</label>
                                        <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Current password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">Nova Senha</label>
                                        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Confirmar Nova Senha</label>
                                        <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

@endsection
