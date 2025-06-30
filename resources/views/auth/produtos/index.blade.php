@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between">
        <x-titlepage text="Lista de produtos" />
        <div><x-btnadd text="Adicionar produto" btnHref="{{ route('products.create') }}" /></div>
    </div>

    <div class="row">
        @if ($products->count() > 0)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome do produto</th>
                                        <th>Status</th>
                                        <th>Criado por:</th>
                                        <th style="width: 100px">Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome do produto</th>
                                        <th>Status</th>
                                        <th>Criado por:</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->is_active ? 'Ativo' : 'Inativo' }}</td>
                                            <td>{{ $product->user->name }}</td>
                                            <td class="text-end">
                                                <x-btnedit btnHref="{{ route('products.edit', $product->id) }}" />

                                                <x-btndelete actionBtn="{{ route('products.destroy', $product->id) }}"
                                                    aletbtn="Tem certeza que deseja excluir este produto?" />
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
                <p class="lead text-center w-100">Sem produtos</p>
            </div>
        @endif

    </div>
@endsection
