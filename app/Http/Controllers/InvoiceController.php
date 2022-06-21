<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    public function index()
    {

        // Compueba si es admin
        if (Auth::user()->role != 'ROLE_ADMIN') {
            return redirect()->route('shop.products.index')->with('error', 'No tienes permiso para acceder.');
        }

        $invoices = Invoice::with('user')->get();

        //Obtenemos todos los usuarios con sus facturas pendientes
        $users = User::with([
            'pending_invoice.product',
            ])->get();

        $products = [];
        $pendings_invoices = [];

        //Extrae cada usuario
        foreach ($users as $user) {

            //Comprueba que tenga factura pendiente
            if (!$user->pending_invoice->isEmpty()) {

                //Obtiene cada compra no facturada
                foreach ($user->pending_invoice as $pending_invoice) {
                    // dd($pending_invoice->product);
                    //Guarda en un arreglo los productos pendientes de facturar del usuario
                    // foreach($pending_invoice->product as $product){
                    //     dd($product->name);
                        $products[] = $pending_invoice->product;
                    // }
                }

                //Arreglo de cada factura pendiente
                $pendings_invoices[] = [
                    'user_name' => $user->name,
                    'products' => $products,
                ];

                $products = [];
            }

        }

        return view('admin.invoices.invoices_index', [
            'invoices' => $invoices,
            'pendings_invoices' => $pendings_invoices,
            'action' => route('invoice.generate'),
            'method' => 'POST',
        ]);
    }

    public function show($id)
    {

        // Compueba si es admin
        if (Auth::user()->role != 'ROLE_ADMIN') {
            return redirect()->route('shop.products.index')->with('error', 'No tienes permiso para acceder.');
        }

        $invoice = Invoice::with([
            'sales.product',
            'user',
        ])->where('id', $id)->first();

        if (!$invoice) {
            // Redirecciona al index despues de generar las facturas
            return redirect()->route('invoice.index')
            ->with('error', 'No existe la factura.');
        }

        return view('admin.invoices.invoice_show', ['invoice' => $invoice]);
    }

    public function store()
    {

        // Compueba si es admin
        if (Auth::user()->role != 'ROLE_ADMIN') {
            return redirect()->route('shop.products.index')->with('error', 'No tienes permiso para acceder.');
        }

        //Obtenemos todos los usuarios con sus facturas pendientes
        $users = User::with('pending_invoice.product')->get();

        $products = [];
        $pendings_invoices = [];

        $total = 0;
        $total_tax = 0;

        //Extrae cada usuario
        foreach ($users as $user) {

            //Comprueba que tenga factura pendiente
            if (!$user->pending_invoice->isEmpty()) {

                //Obtiene cada compra no facturada
                foreach ($user->pending_invoice as $pending_invoice) {
                    $sales_ids[] = $pending_invoice->id;
                    //Guarda en un arreglo los productos pendientes de facturar del usuario
                        $product = $pending_invoice->product;
                        $products[] = $product;

                        $total += $product->price;
                        $tax = ($product->tax / 100) + 1;
                        $total_tax += ( $product->price - ($product->price / $tax) );
                }

                //Crea la factura
                $invoice = Invoice::create([
                    'total_cost' => $total,
                    'total_tax' => $total_tax,
                    'user_id' => $user->id,
                ]);

                //Inserta los productos en la tabla pivote sales_invoices
                foreach ($sales_ids as $id) {
                    //Guarda en la tabla pivote de tareas ligada al usuario
                    $invoice->sales()->attach($id);

                    //Busca la venta y marca que ya tiene factura
                    $sale = Sale::find($id);
                    $sale->update([
                        'invoice_id' => $invoice->id,
                    ]);
                }

                $products = [];
                $total = 0;
                $total_tax = 0;
                $sales_ids = [];
            }

        }

        // Redirecciona al index despues de generar las facturas
        return redirect()->route('invoice.index')
        ->with('success', 'Se generaron las facturas correctamente');

    }

}
