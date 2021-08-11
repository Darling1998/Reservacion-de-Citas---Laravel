<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="card">
        <div class="card-header">
            <input wire:model="search" class="form-control" type="text" placeholder="Ingrese el nombre o correo de usuario">
        </div>

        @if ($users->count())
            <div class="card-body table-responsive">
{{--                 <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre y Apellidos</th>
                            <th>Email</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->nombres}} {{$user->apellidos}}</td>
                            <td>{{$user->email}}</td>
                            <td width="10px">
                                <a class="btn btn-primary" href="{{route('admin.users.edit',$user)}}">Editar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> --}}

                <table  class="display table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre y Apellidos</th>
                            <th>Género</th>
                            <th>Tipo</th>
                            <th>Correo electrónico</th>
                            <th>Estado</th>
                            <th>Opciones</th> 
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                        <tr class="row{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nombres }} {{$user->apellidos}}</td>
                           
                            @if ($user->genero == 'F')
                                <td  style=" color:rgb(236, 110, 188)" class="fas fa-female fa-2x pink-text"></i></td>
                            @else
                            
                                <td style=" color:rgb(71, 165, 189)" ><i class="fas fa-male fa-2x blue-text"></i></td>
                            @endif

                            <td>
                                @if ( $user->hasRole('admin') )
                                    <b>Administrador</b>
                                @elseif ($user->hasRole('asistente') )
                                    <b>Asistente Médico</b>
                                @elseif($user->hasRole('doctor'))
                                    <b> Médico</b>
                                @else
                                <b> Paciente</b>                              
                                @endif
                            </td>
                            <td>{{ $user->email  }}</td>
                            @if ($user->estado=='A')
                            <td><span class="badge badge-success">{{$user->estado}}</span></td>
                            @else
                            <td><span class="badge badge-warning">{{$user->estado}}</span></td>
                            @endif
                           
                            <td width="10px">
                                <a class="btn btn-primary btn-rounded" href="{{route('admin.users.show',$user->id)}}"><i class="fas fa-eye" style="color: white;"></i></a>
                                <a class="btn btn-primary btn-rounded" href="{{route('admin.users.edit',$user->id)}}"><i class="fas fa-pencil-alt" style="color: white;"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                
                </table>
            </div>
            <div class="card-footer">
                {{$users->links()}}
            </div>
                 
        @else
            <div class="card-body">
                <strong>No existen registros</strong>
            </div>
       
        @endif

    </div>
</div>
