<div class="card product text-left">
    <div class="absolute actions">
        @if(Auth::check() && $isadmin)
            <a href="{{url('/products/'.$product->id.'/edit')}}">Editar</a>
            @include('products.delete', ['product' => $product])
        @endif
    </div>
  <h1>{{$product->title}}</h1>


  <div class="row">


    <div class="col-sm-6 col-xs-12">
        @if($product->extension)
            <img src="{{url("/products/images/$product->id.$product->extension")}}" class="product-avatar">
        @endif
    </div>
    <div class="col-sm-6 col-xs-12">
      <strong style="font-size: 1.5em;">Precio:<span>{{$product->pricing}}</span></strong>

      <p>
        <strong>Descripción</strong>
      </p>
      <p>
        {{$product->description}}
      </p>
      <p>
        @include('in_shopping_carts.form', ['product'=>$product])
      </p>
    </div>
  </div>
</div>
