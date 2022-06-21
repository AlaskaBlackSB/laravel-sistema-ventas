@extends('layouts.app')

@section('content')

<div class="container w-auto">
    <div class="bg-white border border-dark px-3">
        <h3 class="text-center border-bottom pt-2 pb-2">Editar una tarea</h3>

        {{-- Muestra mensaje de exito al crear la liga --}}
        @include('components.show-messages-success-errors')

        <div class="p-3 ">
            <form method="POST" action="{{ isset($action)? $action : '' }}">
                @csrf
                @method(isset($method) ? $method : 'POST')

                <div class="mb-3">
                    <label
                      for="name"
                      class="form-label
                          @error('name')
                              is-invalid
                          @enderror
                      "
                      @error('name')
                          autofocus
                      @enderror
                      >Nombre:</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" value="{{$product->name}}">
                    <div id="nameHelp" class="form-text">Nombre del producto.</div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label
                      for="price"
                      class="form-label
                          @error('price')
                              is-invalid
                          @enderror
                      "
                      @error('price')
                          autofocus
                      @enderror
                      >Precio:</label>
                    <input type="text" name="price" class="form-control" id="price" aria-describedby="priceHelp"  value="{{$product->price}}">
                    <div id="priceHelp" class="form-text">Precio del producto.</div>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label
                      for="tax"
                      class="form-label
                          @error('tax')
                              is-invalid
                          @enderror
                      "
                      @error('tax')
                          autofocus
                      @enderror
                      >Impuesto:</label>
                    <input type="text" name="tax" class="form-control" id="tax" aria-describedby="taxHelp"  value="{{$product->tax}}">
                    <div id="taxHelp" class="form-text">Impuesto del producto en número entero.</div>
                    @error('tax')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                <button type="submit" class="btn btn-primary">Editar</button>
              </form>
        </div>
    </div>

    @include('shop.products.components.show_products')
</div>

@endsection

