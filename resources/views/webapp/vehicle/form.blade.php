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
            @if($is_create)
            <form action="{{route('vehicles_save')}}" method="post" class="row" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <div class="mb-3 col-lg-12">
                            <label>Nombre <span class="required">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" maxlength="255"
                                required autofocus>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label>Número placa <span class="required">*</span></label>
                            <input type="text" name="number_plate" value="{{ old('number_plate') }}" class="form-control"
                                maxlength="20" required>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label>Seleccione marca <span class="required">*</span></label>
                            <select class="form-select" name="brand_id">
                                @foreach($brands as $brand)
                                <option value="{{$brand->id}}" {{ old('brand_id')==$brand->id ? 'selected' : ''
                                    }}>{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label>Caracteristicas </label>
                            <textarea class="form-control" name="features" value="{{ old('features') }}" rows="2"
                                style="resize: none;"></textarea>
                        </div>
                    </div>                    
                </div>
                
                {{-- <div class="mb-3 col-lg-3" style="margin-top: 20px">
                    <input name="image" type="file" id="image">
                </div> --}}
                <div class="col-lg-4 col-12">
                    <p class="text-center">
                        <input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)"
                            style="display: none;"></p>
                            <p class="text-center"><img id="output" width="200" src="{{ asset('/images/default.png') }}"/></p>
                    <p class="text-center">
                        <div id="title_image" class="text-center" style="font-size: 11px;"></div>
                        <div class="text-center">
                            <a class="btn btn-sm btn-outline-success"><label for="file" style="cursor: pointer;"><i class="fa-solid fa-upload"></i> Seleccionar Imagen</label></a>
                        </div>
                    </p>                    
                </div>
                <div class="col-lg-12 text-right" style="margin-top: 30px">
                    <a class="btn btn-secondary" href="{{route('vehicles')}}">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
            @else
            <form action="{{route('vehicles_updated',['id'=>$item->id])}}" method="post" class="row" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="col-lg-8 col-12">
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <label>Nombre <span class="required">*</span></label>
                                <input type="text" name="name" value="{{ $item->name }}" class="form-control" maxlength="255"
                                    required autofocus>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label>Número placa <span class="required">*</span></label>
                                <input type="text" name="number_plate" value="{{ $item->number_plate }}" class="form-control"
                                    maxlength="20" required>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label>Seleccione marca <span class="required">*</span></label>
                                <select class="form-select" name="brand_id">
                                    @foreach($brands as $brand)
                                    @if($brand->id == $item->brand_id)
                                    <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                    @else
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label>Caracteristicas </label>
                                <textarea class="form-control" name="features" value="{{ $item->features }}" rows="2"
                                    style="resize: none;"></textarea>
                            </div>
                        </div>
                </div>
                <div class="col-lg-4 col-12">
                    <p class="text-center">
                        <input type="hidden" value="{{$item->image}}" name="url_image">
                        <input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)"
                            style="display: none;"></p>
                            <p class="text-center">
                                <img id="output" width="200" src="{{ asset($item->image!== null ? '/images/'.$item->image : '/images/default.png')}}" />
                                {{-- <img id="output" width="200" 
                                src="{{ asset('/images/'.$item->image) }}"/> --}}
                            </p>
                    <p class="text-center">
                        <div id="title_image" class="text-center" style="font-size: 11px;">{{ $item->image}}</div>
                        <div class="text-center">
                            <a class="btn btn-sm btn-outline-success"><label for="file" style="cursor: pointer;"><i class="fa-solid fa-upload"></i> Seleccionar Imagen</label></a>
                        </div>
                    </p>                    
                </div>
                <div class="col-lg-12 text-right" style="margin-top: 30px">
                    <a class="btn btn-secondary" href="{{route('vehicles')}}">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        @if($is_create)
                        <span>Guardar</span>
                        @else
                        <span>Guardar cambios</span>
                        @endif
                    </button>
                </div>
            </form>
            @endif

        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');           
            image.src = URL.createObjectURL(event.target.files[0]);
            $("#title_image").html(event.target.files[0].name)
        };
    </script>
@endsection