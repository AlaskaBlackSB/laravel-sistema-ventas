<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('shop.products.products_index', [
            'products' => $products,
            'action' => route('products.store'),
            'method' => 'POST',
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        //Crea el producto
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'tax' => $request->tax,
        ]);

        //Redirecciona al index de tareas
        return redirect()->route('products.index')
        ->with('success', 'Producto registrado correctamente.');

    }

    public function edit($id)
    {

        //Busca el producto
        $product = Product::find($id);

        //Busca todos los productos
        $products= Product::all();

        if (!$product) {
            return redirect()->route('products.index')
            ->with('error', 'El producto que se intenta editar no existe.');
        }

        return View('shop.products.product_show', [
            'product' => $product,
            'products' => $products,
            'action' => route('products.update', ['product_id' => $product->id]),
            'method' => 'PUT',
        ]);
    }

    public function update(CreateProductRequest $request, $id)
    {

        //Busca el producto
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')
            ->with('error', 'El producto que se intenta editar no existe.');
        }

        // Actualiza la tarea
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'tax' => $request->tax,
        ]);

        //Redirecciona al index de tareas
        return redirect()->route('products.index')
        ->with('success', 'Producto actualizado correctamente.');

    }

    public function destroy($id)
    {

        //Busca el producto
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')
            ->with('error', 'El producto que se intenta editar no existe.');
        }

        //Elimina el producto
        $product->delete();

        //Redirecciona al index de tareas
        return redirect()->route('products.index')
        ->with('success', 'Producto eliminado correctamente.');

    }
}
