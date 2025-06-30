<div class="w-full d-flex gap-1 flex-column">

    <x-btnsidebar text="Dashboard" icon="tachometer" href="admin.index" />
    <x-btnsidebar text="Marcas" icon="tag" href="brands.index" />
    <x-btnsidebar text="Categorias" icon="cube" href="categories.index" />
    <x-btnsidebar text="Produtos" icon="cubes" href="products.index" />

    @if (Auth::user()->is_master)
        <x-btnsidebar text="Usuários" icon="user" href="users.index" />
    @endif

</div>
