@extends('index')
@section('content')
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="m-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="col-lg-12 col-md-12 col-12">
    <div class="row">
        <div class="col-lg-6 col-12">
            <a class="text-dark bold" href="{{route('vehicles')}}" style="text-decoration: none;">
                <i class="fa-solid fa-arrow-left-long"></i>
                @if($is_create)
                <span>Registrar vehículo</span>
                @else
                <span>Editar vehículo</span>
                @endif
            </a>
        </div>
        <div class="col-sm-6 text-right">
            <p class="color-danger">Campos requeridos (<span class="color-danger">*</span>)</p>
        </div>
    </div>

</div>
<div class="col-lg-12 col-md-12 col-12">
    <div class="card">
        <div class="card-body">
            <form action="{{route('vehicles_save')}}" method="post" class="row">
                {!! csrf_field() !!}
                <div class="mb-3 col-lg-6">
                    <label>Nombre <span class="required">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" maxlength="255" required autofocus>
                </div>
                <div class="mb-3 col-lg-3">
                    <label>Número placa <span class="required">*</span></label>
                    <input type="text" name="number_plate" value="{{ old('number_plate') }}" class="form-control" maxlength="20" required>
                </div>
                <div class="mb-3 col-lg-3">
                    <label>Seleccione marca <span class="required">*</span></label>
                    <select class="form-select" name="brand_id">
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-lg-6">
                    <label>Caracteristicas </label>
                    <textarea class="form-control" name="features" value="{{ old('features') }}" rows="2" style="resize: none;"></textarea>
                </div>
                <div class="col-lg-12 text-right" style="margin-top: 30px">
                    <a class="btn btn-secondary" href="{{route('vehicles')}}">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection