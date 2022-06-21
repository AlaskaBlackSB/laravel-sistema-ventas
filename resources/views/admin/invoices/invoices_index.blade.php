@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-primary">Facturas realizadas</h1>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Usuario</th>
            <th scope="col">Total</th>
            <th scope="col">Total de impuestos</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <th scope="row">{{$invoice->id}}</th>
                    <td>{{$invoice->user->name}}</td>
                    <td>$ {{$invoice->total_cost}}</td>
                    <td>$ {{$invoice->total_tax}}</td>
                    <td>
                        <a href="{{route('invoice.show', ['invoice_id' => $invoice->id])}}">ver factura</a>
                    </td>
                </tr>
            @empty
            <div class="alert alert-danger d-flex align-items-center justify-content-center text-center py-2" role="alert">
                <p>No hay facturas registradas</p>
            </div>
            @endforelse

        </tbody>
      </table>

    <h1 class="text-primary">Factura(s) pendiente(s)</h1>


    @if (!empty($pendings_invoices))
        <form method="POST" action="{{ isset($action)? $action : '' }}">
            @csrf
            @method(isset($method) ? $method : 'POST')

            <button type="submit" class="btn btn-primary">Generar todas</button>
        </form>
    @endif


    <table class="table">
        <thead>
          <tr>
            <th scope="col">Usuario</th>
            <th scope="col">productos</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($pendings_invoices as $pending_invoice)
                <tr>
                    <th scope="row">{{$pending_invoice['user_name']}}</th>
                    <th>
                        @foreach ($pending_invoice['products'] as $product)
                            <p>{{$product->name}}</p>
                        @endforeach
                    </th>
                </tr>
            @empty
            <div class="alert alert-danger d-flex align-items-center justify-content-center text-center py-2" role="alert">
                <p>No hay facturas pendientes</p>
            </div>
            @endforelse

        </tbody>
      </table>
</div>

@endsection
