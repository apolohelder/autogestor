@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between">
        <x-titlepage text="Lista de Marcas" />
        <div><x-btnadd text="Adicionar Marca" btnHref="{{ route('brands.create') }}" /></div>
    </div>

    <div class="row">

        @if ($brands->count() > 0)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome da Marca</th>
                                        <th>Produtos</th>
                                        <th style="width: 100px">Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome da Marca</th>
                                        <th>Produtos</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>
                                                {{ $brand->name }}
                                            </td>
                                            <td>
                                                <a class="btn btn-link text-decoration-none"
                                                    href="{{ route('brands.show', $brand->name) }}">
                                                    {{ $brand->products->count() }}
                                                </a>
                                            </td>
                                            <td>

                                                <x-btnedit btnHref="{{ route('brands.edit', $brand->id) }}" />

                                                <x-btndelete actionBtn="{{ route('brands.destroy', $brand->id) }}"
                                                    aletbtn="Tem certeza que deseja excluir esta categoria?" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="h-75 d-flex align-items-center">
                <p class="lead text-center w-100">Sem Marca cadastradas</p>
            </div>
        @endif

    </div>
@endsection
