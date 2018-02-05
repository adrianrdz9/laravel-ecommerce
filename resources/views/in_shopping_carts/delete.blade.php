{!! Form::open(['url' => '/in_shopping_carts/'.$product->id,'method' => 'DELETE', 'class' => 'inline-block']) !!}
  <input type="submit" value="Eliminar" class="btn btn-link red-text no-padding no-marging no-transform">
{!! Form::close() !!}
