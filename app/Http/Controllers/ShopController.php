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
        //Busca el producto
        $product = Product::find($request->product_id);

        // Genera la compra
        $sale = Sale::create([
            'product_id' => $request->product_id,
            'total' => $product->price,
            'user_id' => Auth::id(),
        ]);

        // Crea la solicitud de factura
        Invoice::create([
            'sale_id' => $sale->id
        ]);

        //redirecciona a /shop
        return redirect()->route('shop.products.index');
    }
}
