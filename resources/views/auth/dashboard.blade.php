@extends('layouts.admin')

@section('content')
    <x-titlepage text="Dashboard" />

    <div class="row gap-2">

        @if ((Auth::user()->is_master ?? false) && ($userCount ?? 0) > 0)
            <x-carddesh color="primary" icon="users" text="Usuários" route="users.index" :count="$userCount" />
        @endif

        @if ($brandsCount ?? 0 > 0)
            <x-carddesh color="warning" icon="tag" text="Marcas" route="brands.index" :count="$brandsCount" />
        @endif

        @if (($categoriesCount ?? 0) > 0)
            <x-carddesh color="info" icon="cube" text="Categorias" route="categories.index" :count="$categoriesCount" />
        @endif

        @if (($productsCount ?? 0) > 0)
            <x-carddesh color="teal" icon="cubes" text="Produtos" route="products.index" :count="$productsCount" />
        @endif

    </div>
@endsection
