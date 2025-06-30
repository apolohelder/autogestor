@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between">
        <x-titlepage text="Criar Usuário" />
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">

                    <form class="row gap-5 needs-validation" action="{{ route('users.store') }}" method="POST"
                        autocomplete="off" novalidate enctype="multipart/form-data">

                        @csrf

                        <div class="col-md-4">

                            <x-input required typeinput="text" text="Nome" infor="name"
                                placeholder="NInforme seu nome completo" value="{{ old('name') }}" />

                            <x-input required typeinput="email" text="E-mail" infor="email"
                                placeholder="Ex: email@example.com" value="{{ old('email') }}" />

                            <x-input class="telefone" typeinput="tel" text="Telefone" infor="telephone"
                                placeholder="Celular ou Telefone fixo" value="{{ old('telephone') }}" />

                            <x-input required typeinput="password" text="Senha" infor="password" placeholder="Senha"
                                value="{{ old('password') }}" />

                            <x-input required typeinput="password" text="Confirmar Senha" infor="password_confirmation"
                                placeholder="Confirmar Senha" value="{{ old('password_confirmation') }}" />

                        </div>

                        <div class="col-md-4">

                            <div class="mb-5">
                                <label for="profile_photo" class="form-label"><strong>Selecione uma foto de
                                        perfil</strong></label>
                                <input class="form-control form-control-lg " id="profile_photo" name="profile_photo"
                                    type="file" accept="image/jpeg,image/png,image/jpg,image/gif">
                            </div>

                            <div class="mb-5">

                                <p class="form-label"><strong>Permissões</strong></p>
                                <input type="checkbox" class="btn-check" id="is_master" name="is_master" value="1"
                                    autocomplete="off">
                                <label class="btn btn-outline-success" for="is_master">Usuário Master</label>

                            </div>

                        </div>

                        <div>
                            <button type="submit" class="btn btn-warning btn-lg"> Criar Usuário </button>
                            <a href="{{ route('users.index') }}" class="btn btn-lg btn-outline-secondary">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
