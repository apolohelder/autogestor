<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;    
use App\Models\Product;
use App\Models\Brand;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Exibir uma lista do recurso.
     */
    public function index(){

        $user = auth()->user();
        
        if ($user->is_master) {
            // Se o usuário for master, ele verá todos os produtos
            $products = Product::with('categories')->get();
        } else {
            // Caso contrário, ele verá apenas os produtos que ele criou
            $products = Product::with('categories')->where('user_id', $user->id)->get();
        }

        return view('auth.produtos.index', [
            'products' => $products,
        ]);
    }

    /**
     * Mostrar o formulário para criar um novo recurso.
     */
    public function create(){
        $categories = Category::all();
        $brands = Brand::all();

        // Verifique se há categorias registradas
        $categoriesCount = Category::count();

        // Verifique se há marcas registradas
        $brandsCount = Brand::count();
        
        if ($categoriesCount === 0) {
            return redirect()->route('products.index')->with('error', 'Você precisa cadastrar uma categoria antes de adicionar um produto.');
        }

        if ($brandsCount === 0) {
            return redirect()->route('products.index')->with('error', 'Você precisa cadastrar uma marca antes de adicionar um produto.');
        }

        return view('auth.produtos.create', compact('categories', 'brands'));
    }

    /**
     * Armazene um recurso recém-criado no armazenamento.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $data = $request->except('categories');
            $data['user_id'] = auth()->id();
            $data['brand_id'] = $request->brand_id ?? Brand::first()->id;
    
            $product = Product::create($data);
            $product->categories()->sync($request->categories);
    
            return redirect()->route('products.index')->with('success', 'Produto criado com sucesso.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar produto: ' . $e->getMessage());
        }
    }

    /**
     * Exibir o recurso especificado.
     */
    public function show($name){
        $product = Product::with(['categories', 'brand', 'user'])
                ->where('name', $name)
                ->firstOrFail();
        return view('auth.produtos.show', compact('product'));
    }

    /**
     * Mostrar o formulário para edição do recurso especificado.
     */
    public function edit($id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $this->authorize('update', $product);
        $categories = Category::all()->sortByDesc(function($category) use ($product) {
            // Categorias selecionadas aparecem primeiro (ordenadas por 1)
            return $product->categories->contains($category->id) ? 1 : 0;
        });

        $brands = Brand::all();

        return view('auth.produtos.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Atualize o recurso especificado no armazenamento.
     */
    public function update(UpdateProductRequest $request, $id){
        
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);
        $product->update($request->except('categories'));
        
        // Sincroniza as categorias
        $product->categories()->sync($request->categories);
        
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso.');
    }


    /**
     * Remover o recurso especificado do armazenamento.
     */
    public function destroy($id){
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();
        
        return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso.');
    }
}
