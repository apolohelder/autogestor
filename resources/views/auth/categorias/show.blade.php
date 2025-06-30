@extends('layouts.admin')

@section('content')

    <x-titlepage text="Produtos na categoria: {{ $category->name }}" />

    @if ($products->isEmpty())
        <p>Nenhum produto encontrado para esta categoria.</p>
    @else
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nome do produto</th>
                                    <th>Valor</th>
                                    <th style="width: 100px">Ação</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nome do produto</th>
                                    <th>Valor</th>
                                    <th>Ação</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($products as $product)
                                    @if ($product->is_active)
                                        <tr>
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                R$ {{ number_format($product->price, 2, ',', '.') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('auth.produtos.show', $product->name) }}">Veja mais</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
