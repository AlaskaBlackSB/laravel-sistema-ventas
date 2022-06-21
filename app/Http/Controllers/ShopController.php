<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ShopController extends Controller
{
    public function index()
    {
        // Compueba si es admin
        if (Auth::user()->role != 'ROLE_USER') {
            return redirect()->route('invoice.index')->with('error', 'No tienes permiso para acceder.');
        }

        //Extrae todos los producto
        $products = Product::all();

        //Retorna la vista que muestra los productos
        return view('shop.shop_index', [
            'products' => $products,
            'action' => route('shop.sale.store'),
            'method' => 'POST',
        ]);
    }

    public function store(StoreSaleRequest $request)
    {

        // Compueba si es admin
        if (Auth::user()->role != 'ROLE_USER') {
            return redirect()->route('invoice.index')->with('error', 'No tienes permiso para acceder.');
        }

        //Busca el producto
        $product = Product::find($request->product_id);

        // Genera la compra
        $sale = Sale::create([
            'product_id' => $request->product_id,
            'total' => $product->price,
            'user_id' => Auth::id(),
            'invoice_id' => null, //indica que no tiene factura
        ]);

        //redirecciona a /shop
        return redirect()->route('shop.products.index');
    }
}
