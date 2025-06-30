@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between">
        <x-titlepage text="Editar Usuário" />
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <form class="row gap-5 needs-validation" action="{{ route('users.update', $user->id) }}" method="POST"
                        autocomplete="off" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-4">
                            <x-input required typeinput="text" text="Nome do usuário" infor="name"
                                placeholder="Nome do usuário" value="{{ old('name', $user->name) }}" />

                            <x-input required typeinput="email" text="E-mail" infor="email" placeholder="E-mail"
                                value="{{ old('email', $user->email) }}" />

                            <x-input class="telefone" typeinput="tel" text="Telefone" infor="telephone"
                                placeholder=">Telefone" value="{{ old('telephone', $user->telephone) }}" />

                            <small>Deixe em branco para manter a senha atual.</small>
                            <x-input typeinput="password" text="Nova Senha" infor="password" placeholder="Nova Senha"
                                value="{{ old('password') }}" />

                            <x-input typeinput="password" text="Confirmar Nova Senha" infor="password_confirmation"
                                placeholder=">Confirmar Nova Senha" value="{{ old('password_confirmation') }}" />
                        </div>

                        <div class="col-md-4">

                            <div class="mb-5">
                                <label for="profile_photo" class="form-label"><strong>Foto de perfil</strong></label>

                                {{--  Container da imagem (visível quando há foto)  --}}
                                <div id="photo-container"
                                    class="{{ isset($user) && $user->profile_photo_path ? '' : 'd-none' }}">
                                    @if (isset($user) && $user->profile_photo_path)
                                        <div class="d-flex align-items-center gap-3 position-relative" style="width: 250px">
                                            <img src="{{ $user->profile_photo_url }}" alt="Foto de perfil"
                                                class="img-thumbnail" width="250">
                                            <button type="button" id="remove-photo-btn"
                                                class="btn btn-danger btn-sm position-absolute top-0 end-0">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                {{--  Input file (oculto quando há foto)  --}}
                                <div id="upload-container"
                                    class="{{ isset($user) && $user->profile_photo_path ? 'd-none' : '' }}">
                                    <input class="form-control form-control-lg" id="profile_photo" name="profile_photo"
                                        type="file" accept="image/jpeg,image/png,image/jpg,image/gif">
                                    <small class="text-muted">Formatos aceitos: JPEG, PNG, JPG, GIF (até 2MB)</small>
                                </div>

                                {{--  Campo oculto para indicar remoção da foto  --}}
                                <input type="hidden" id="remove_photo" name="remove_photo" value="0">
                            </div>

                            <div class="mb-5">

                                <p class="form-label"><strong>Permissões</strong></p>
                                <input type="checkbox" class="btn-check" id="is_master" name="is_master" value="1"
                                    {{ $user->is_master ? 'checked' : '' }} autocomplete="off">
                                <label class="btn btn-outline-success" for="is_master">Usuário Master</label>

                            </div>

                        </div>


                        <div>
                            <button type="submit" class="btn btn-warning btn-lg"> Atualizar usuário </button>

                            @php $cancelRoute = Auth::user()->is_master ? 'users.index' : 'admin.index'; @endphp

                            <a href="{{ route($cancelRoute) }}" class="btn btn-lg btn-outline-secondary">Cancelar</a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
