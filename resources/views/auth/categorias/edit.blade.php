@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between">
        <x-titlepage text="Editar categoria" />
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body pb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <form class="pt-4" action="{{ route('categories.update', $category->id) }}" method="POST">

                                @csrf

                                @method('PUT')

                                <x-input typeinput="text" text="Nome da categoria" infor="name"
                                    placeholder="Nome da Categoria" value="{{ old('name', $category->name) }}" />

                                <x-btnsubmit text="Atualizar categoria" />
                                <a href="{{ route('categories.index') }}"
                                    class="btn btn-lg btn-outline-secondary">Cancelar</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
