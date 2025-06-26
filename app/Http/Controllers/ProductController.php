<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController 
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produto cadastrado!');
    }
    
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produto atualizado!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso!');
    }

    // Métodos para funcionalidade de estoque
    public function stockIndex()
    {
        // Busca todas as categorias distintas que possuem produtos
        $categories = Product::select('category')
                             ->whereNotNull('category')
                             ->where('category', '!=', '')
                             ->distinct()
                             ->get();
        
        return view('products.stock.index', compact('categories'));
    }

    public function stockByCategory($category)
    {
        // Busca todos os produtos de uma categoria específica
        $products = Product::where('category', $category)->get();
        
        return view('products.stock.category', compact('products', 'category'));
    }
}

