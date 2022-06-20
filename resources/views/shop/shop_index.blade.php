@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-primary">Productos disponibles</h1>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Nombre	Precio (impuesto incluido)</th>
            <th scope="col">Impuesto</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->tax}}</td>
                    <td>
                        <form method="POST" action="{{ isset($action)? $action : '' }}">
                            @csrf
                            @method(isset($method) ? $method : 'POST')

                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button type="submit" class="btn btn-primary">Comprar</button>
                        </form>

                    </td>
                </tr>
            @empty
            <div class="alert alert-danger d-flex align-items-center justify-content-center text-center py-2" role="alert">
                <p>No hay tareas registradas</p>
            </div>
            @endforelse

        </tbody>
      </table>
</div>

@endsection
