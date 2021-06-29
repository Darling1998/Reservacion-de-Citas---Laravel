<div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', null, ['class'=>'form-control']) !!}

    {!! Form::label('descripcion', 'Descripción') !!}
    {!! Form::text('descripcion', null, ['class'=>'form-control']) !!}
 
    @error('nombre')
        <small class="text-danger">
           {{$message}}
        </small>
    @enderror
 
 </div>
