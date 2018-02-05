@extends("layouts.app")
@section("content")
    <div class="big-padding  text-center blue-grey white-text">
        <h1>Tu carrito de compras</h1>
    </div>
    @if($products != "[]")
        <div class="container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Producto</td>
                        <td>Precio</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index=>$product)
                        <tr>
                            <td>{{$product->title}}</td>
                            <td>{{$product->pricing}}</td>
                            <td>
                                {!! Form::open(['url' => '/in_shopping_carts/'.$inShoppingCarts->get()[$index]->id,'method' => 'DELETE', 'class' => 'inline-block']) !!}
                                  <input type="submit" value="Eliminar" class="btn btn-link red-text no-padding no-marging no-transform">
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                    <tr>

                        <td><b style="font-size: 1.2em;">Total</b></td>
                        <td><b style="font-size: 1.2em;">{{$total}}</b></td>
                    </tr>
                </tbody>
            </table>

            <div class="text-right">
                @include('shopping_carts.form')
            </div>
        </div>
    @else
        <h1><center>Tu carrito aun no tiene ningun producto</center></h1>
    @endif
@endsection
