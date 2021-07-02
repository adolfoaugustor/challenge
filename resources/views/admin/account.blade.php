@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Conta') }}</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">

                <div class="card-header text-center">
                    <div class="card-profile-image">
                        <img src="{{ asset('img/cifrao2.png') }}" style="width: 100px;">
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('account.store') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="social_reason">Razão Social *</label>
                                    <input type="text" id="social_reason" class="form-control" name="social_reason" value="{{ old('social_reason') }}" placeholder="Razão Social" require>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="fantasy_name">Nome Fantasia *</label>
                                    <input type="text" id="fantasy_name" class="form-control" name="fantasy_name" value="{{ old('fantasy_name') }}" placeholder="Nome Fantasia" require>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="name">Responsável da Conta</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ Auth::user()->name }}" disabled>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="cpf_cnpj">CPF / CNPJ *</label>
                                    <input type="text" id="cpf_cnpj" class="form-control" name="cpf_cnpj" value="{{ Auth::user()->cpf_cnpj }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="name">Saldo *</label>
                                    <input type="number" step="0.01" id="amount" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="0,00" require>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Abrir Conta</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection
