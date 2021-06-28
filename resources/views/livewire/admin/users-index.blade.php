<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="card">
        <div class="card-header">
            <input wire:model="search" class="form-control" type="text" placeholder="Ingrese el nombre o correo de usuario">
        </div>

        @if ($users->count())
            <div class="card-body table1">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->nombres}}</td>
                            <td>{{$user->email}}</td>
                            <td width="10px">
                                <a class="btn btn-primary" href="{{route('admin.users.edit',$user)}}">Editar</a>
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
