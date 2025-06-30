<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Exibir uma lista de categorias na página.
     */
    public function index(){
        $categories = Category::all();
        return view('auth.categorias.index', compact('categories'));
    }

    /**
     * Página de formulário de categoria.
     */
    public function create() {
        return view('auth.categorias.create');
    }

    /**
     * Armazenar um recurso recém-criado no armazenamento.
     */
    public function store(Request $request)    {
        $request->validate(['name' => 'required|string|max:255']);
        Category::create(['name' => $request->name]);
        return redirect()->route('categories.index')->with('success', 'Categoria adicionada com sucesso!');
    }

    /**
     * Exibir o recurso especificado.
     */
    public function show($name){
        $category = Category::where('name', $name)->firstOrFail();
        
        // Loads category products
        $products = $category->products;

        // Returns the view with the list of products
        return view('auth.categorias.show', compact('category', 'products')); 
    }

    /**
     * Mostrar o formulário para edição do recurso especificado.
     */
    public function edit($id){
        $category = Category::findOrFail($id);
        return view('auth.categorias.edit', compact('category'));
    }

    /**
     * Atualizar o recurso especificado no armazenamento.
     */
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    /**
     * Remover o recurso especificado do armazenamento.
     */
    public function destroy($id){
        $category = Category::findOrFail($id);

        // Verifica se a categoria tem produtos associados
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Exclusão de categoria impedida. Produtos ainda vinculados à categoria');
        }

        // Se não houver produtos associados, exclua a categoria
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso.');
    }

    /**
     * Manipula a requisição AJAX para armazenar uma nova categoria.
     *
     * Este método valida a requisição recebida para garantir que o nome da categoria
     * seja fornecido e único. Se a validação for bem-sucedida, cria uma nova categoria
     * e retorna uma resposta JSON indicando sucesso.
     *
     */
    public function ajaxStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'category' => $category,
        ]);
    }

}
