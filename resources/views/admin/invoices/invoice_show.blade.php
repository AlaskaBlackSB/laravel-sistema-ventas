@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-primary">Factura: #{{$invoice->id}} - Cliente: {{$invoice->user->name}}</h1>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Producto</th>
            <th scope="col">Precio</th>
            <th scope="col">Impuesto</th>
            <th scope="col">Fecha (Ordenados)</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($invoice->sales as $sale)
                <tr>
                    <th scope="row">{{$sale->product->id}}</th>
                    <td>{{$sale->product->name}}</td>
                    <td>$ {{$sale->product->price}}</td>
                    <td>% {{$sale->product->tax}}</td>
                    <td>{{$sale->created_at}}</td>
                </tr>
            @empty
                <div class="alert alert-danger d-flex align-items-center justify-content-center text-center py-2" role="alert">
                    <p>No hay facturas registradas</p>
                </div>
            @endforelse

        </tbody>
      </table>

      <p>Total impuestos: ${{$invoice->total_tax}}</p>
      <p>Precio total: ${{$invoice->total_cost}}</p>
</div>

@endsection
