@extends("layouts.app")
@section("content")
    <div class="big-padding  text-center blue-grey white-text">
        <h1>Administradores de esta página</h1>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>Id de Administrador</td>
                    <td>Nombre de Administrador</td>
                    <td>Email del Administrador</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td>
                            @if($admin->ismaster)
                                <input type="submit" value="Eliminar Administrador" class="btn btn-link red-text no-padding no-marging no-transform" disabled="true">
                            @else
                                {!! Form::open(['url' => '/admins/'.$admin->id,'method' => 'PUT', 'class' => 'inline-block']) !!}
                                    <input type="hidden" name="action" value="remove_admin">
                                    <input type="submit" value="Eliminar Administrador" class="btn btn-link red-text no-padding no-marging no-transform">
                                {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="floating">
      <a href="{{url('/admins/new')}}" class="btn btn-primary btn-fab"><i class="material-icons">add</i></a>
    </div>
@endsection
