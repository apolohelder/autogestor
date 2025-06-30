@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between">
        <x-titlepage text="Adicionar nova categoria" />
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <form class="pt-4" action="{{ route('brands.store') }}" method="POST">

                                @csrf

                                <x-input typeinput="text" text="Nome da Marca" infor="name" placeholder="Nome da Marca"
                                    value="{{ old('name') }}" />

                                <x-btnsubmit text="Adicionar marca" />
                                <a href="{{ route('brands.index') }}" class="btn btn-lg btn-outline-secondary">Cancelar</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
