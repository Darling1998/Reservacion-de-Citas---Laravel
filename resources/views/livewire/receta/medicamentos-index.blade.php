
   <div>
        <div class="card">
    
            <div class="card-header">
                <input wire:model="search" class="form-control" placeholder="Ingrese el nombre del producot" type="text" >
            </div>
    
            <div class="card-body">
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <td></td>
                        <th>Descripción</th>
                        <th>Forma Farmaceutica</th>
                        <th>Concentración</th>
                        <th>Vía de Administración</th>
                      </thead>
                      <tbody>
                            @foreach ( $medicamentos as $item )
                                <tr>
                                    <td> 
                                        <div>
                                            <input class="form-check-input" type="radio" name="medicamento_id" id="medicamento_id" value="{{$item->id}}">
                                        </div> 
                                    </td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>{{$item->forma_farmaceutica}}</td>
                                    <td>{{$item->concentracion}}</td>
                                    <td>{{$item->via_administracion}}</td>
                                </tr>
                                
                            @endforeach
    
                      </tbody>
    
                    </table>
                </div>
                <div class="card-footer">
                    {{$medicamentos->links()}}
                </div>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cantidad">Cantidad</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                             name="cantidad" required value="{{ old('cantidad')}}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" >
                             @error('cantidad')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="indicaciones">Indicaciones</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                             name="indicaciones" required value="{{ old('indicaciones')}}" >
                             @error('indicaciones')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>

