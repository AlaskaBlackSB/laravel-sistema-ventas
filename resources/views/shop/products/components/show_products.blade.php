<div class="mt-4 p-3">
    <h2>Productos</h2>
    @if (!$products->isEmpty())
    <div class="table-responsive w-auto">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Impuesto</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <th>{{$product->name}}</th>
                        <th>${{$product->price}}</th>
                        <th>{{$product->tax}}%</th>
                        <th>
                            <a
                            href="{{route('products.edit', ['product_id' => $product->id])}}"
                            >Editar</a>
                        </th>
                        <th>
                            <form method="POST" action="{{route('products.destroy', ['product_id' => $product->id])}}">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert alert-danger d-flex align-items-center justify-content-center text-center py-2" role="alert">
            {{-- <i class="material-icons icon text-danger">warning</i> --}}
                    No hay tareas registradas
        </div>
    @endif
</div>
