@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between">
        <x-titlepage text="Lista de categorias" />
        <div><x-btnadd text="Adicionar categoria" btnHref="{{ route('categories.create') }}" /></div>
    </div>

    <div class="row">

        @if ($categories->count() > 0)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome da categoria</th>
                                        <th>Produtos</th>
                                        <th style="width: 100px">Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome da categoria</th>
                                        <th>Produtos</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                {{ $category->name }}
                                            </td>
                                            <td>
                                                <a class="btn btn-link text-decoration-none"
                                                    href="{{ route('categories.show', $category->name) }}">
                                                    {{ $category->products->count() }}
                                                </a>
                                            </td>
                                            <td>
                                                <x-btnedit btnHref="{{ route('categories.edit', $category->id) }}" />

                                                <x-btndelete actionBtn="{{ route('categories.destroy', $category->id) }}"
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
                <p class="lead text-center w-100">Sem categorias cadastrado</p>
            </div>
        @endif



    </div>
@endsection
