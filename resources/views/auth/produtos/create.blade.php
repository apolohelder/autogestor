@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between">
        <x-titlepage text="Cadastrar Produto" />
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">

                    <form class="row" action="{{ route('products.store') }}" method="POST" autocomplete="off">

                        @csrf

                        <div class="col-md-4">
                            <x-input typeinput="text" text="Nome do Produto" infor="name" placeholder="Nome do Produto"
                                value="{{ old('name') }}" />

                            <x-input typeinput="text" text="Endereço" infor="address" placeholder="Endereço"
                                value="{{ old('address') }}" />

                            <div class="form-floating mb-3">
                                <select class="form-select" id="is_active" name="is_active"
                                    aria-label="Floating label select example">
                                    <option selected hidden value="">Selecione</option>
                                    <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Não</option>
                                </select>
                                <label for="is_active">Ativo</label>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">R$</span>
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="price" name="price" step="0.01"
                                        value="{{ old('price') }}" placeholder="Valor do produto">
                                    <label for="price">Valor do produto</label>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Descrição do Produto" id="description" name="description"
                                    style="height: 100px">
                                        {{ old('description') }}
                                    </textarea>
                                <label for="floatingTextarea2">Descrição do Produto</label>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <x-inputajax text="Nova Marca" btntext="Criar marca" placeholder="Digite uma nova marca"
                                infor="new_brand" idcreate="create_brand_btn" idfeedback="brand_feedback"
                                dataurl="{{ route('brands.ajaxStore') }}" />

                            <div class="form-floating mb-3">
                                <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id"
                                    name="brand_id" required>
                                    <option value="">Selecione uma marca</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="brand_id">Marca *</label>
                                @error('brand_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-4">

                            <x-inputajax text="Nova categoria" btntext="Criar categoria"
                                placeholder="Digite uma nova categoria" infor="new_category" idcreate="create_category_btn"
                                idfeedback="category_feedback" dataurl="{{ route('categories.ajaxStore') }}" />

                            <label class="form-label">Categorias</label>

                            <div class="border rounded p-3 overflow-y-auto" style="max-height: 200px;" id="category-list">
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categories[]"
                                            id="category_{{ $category->id }}" value="{{ $category->id }}"
                                            {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="category_{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @error('categories')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                        </div>

                        <div>
                            <x-btnsubmit text="Criar produto" />
                            <a href="{{ route('products.index') }}" class="btn btn-lg btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
