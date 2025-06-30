<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::withCount('products')->get();
    return view('auth.marcas.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Brand::create($request->only('name'));
        return redirect()->route('brands.index')->with('success', 'Marca criada!');
    }

    /**
     * Display the specified resource.
     */
    public function show($name)
    {
        $brand = Brand::where('name', $name)->firstOrFail();

        // Loads brand products
        $products = $brand->products;

        return view('auth.marcas.show', compact('brand', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('auth.marcas.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $brand = Brand::findOrFail($id);
        $brand->name = $request->input('name');
        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Marca atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        // Verifica se a marca tem produtos associados
        if ($brand->products()->count() > 0) {
            return redirect()->route('brands.index')->with('error', 'Não é possível excluir uma marca com produtos associados.');
        }

        // Se não houver produtos associados, exclua a marca
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Marca excluída com sucesso!');
    }

    /**
     * Manipula a requisição AJAX para armazenar uma nova marca.
     *
     * Este método valida a requisição recebida para garantir que o nome da marca
     * seja fornecido e único. Se a validação for bem-sucedida, cria uma nova marca
     * e retorna uma resposta JSON indicando sucesso.
     *
     */
    public function ajaxStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
        ]);

        $brand = Brand::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'brand' => $brand,
        ]);
    }
}
