@extends('layouts.admin')

@section('content')
    <div class="container pt-5">
        <h1>{{ $product->name }}</h1>
        <p><strong>Descrição:</strong> {{ $product->description }}</p>
        <p><strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</p>
        <p><strong>Marca:</strong> {{ $product->brand->name ?? 'Sem marca definida' }}</p>
        <p><strong>Categorias:</strong> {{ $product->categories->pluck('name')->join(', ') }}</p>
        <p><strong>Status:</strong> {{ $product->is_active ? 'Ativo' : 'Inativo' }}</p>
    </div>
@endsection
