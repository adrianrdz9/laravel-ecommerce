@extends("layouts.app")
@section("content")
    <div class="big-padding  text-center blue-grey white-text">
        <h1>Usuarios de esta página</h1>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>Id de usuario</td>
                    <td>Nombre de usuario</td>
                    <td>Email del usuario</td>
                    <td>¿Administrador?</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @if($user->isMaster())
                            <td  class="indigo white-text text-center">
                                <span class="medium bold">Dueño</span>
                            </td>
                        @elseif($user->isAdmin() && !$user->isMaster())
                            <td  class="yellow black-text text-center">
                                <span class="medium bold">Administrador</span>
                            </td>
                        @elseif(!$user->isAdmin() && !$user->isMaster())
                            <td  class="green white-text text-center">
                                <span class="medium bold">Usuario</span>
                            </td>
                        @endif

                        <td>
                            @if($user->isMaster() || $user->isAdmin())
                                <input type="submit" value="Hacer administrador" class="btn-link grey-text no-padding no-marging no-transform" disabled="true">
                            @else
                                {!! Form::open(['url' => '/admins/'.$user->id,'method' => 'PUT', 'class' => 'inline-block']) !!}
                                    <input type="hidden" name="action" value="add_admin">
                                    <input type="submit" value="Hacer administrador" class="btn-link indigo-text no-padding no-marging no-transform">
                                {!! Form::close() !!}
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="floating">
      <a href="{{url('/admins')}}" class="btn btn-primary btn-fab"><i class="material-icons">arrow_back</i></a>
    </div>
@endsection
