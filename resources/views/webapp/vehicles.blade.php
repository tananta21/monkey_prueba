@extends('index')
@section('content')
@if(Session::has('message'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Muy bien!</strong> {{ Session::get('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="col-lg-12 col-md-12">
    <div class="row">
        <div class="col-lg-6 col-12">
            <h5 class="f-s-18 text-dark bold text-uppercase">Todos los vehículos</h2>
        </div>
        <div class="col-lg-6 col-12 text-right">
            <a href="{{route('vehicles_create')}}" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Nuevo
                vehículo</a>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-12" style="margin-top: 30px">
    <div class="row">
        <div class="col-lg-12 col-12 m-b-15">
            <div class="row">
                <div class="col-lg-5 col-12">
                    <a class="btn btn-secondary btn-sm" style="margin-right: 5px" href="{{route('vehicles')}}"
                        type="button"><i class="fa-solid fa-rotate"></i></a>
                    <div class="dropdown d-inline" style="margin-right: 5px">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Acciones
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" target="_blank" href="{{route('vehicles_pdf')}}"><i class="fa-solid fa-file-pdf"></i> Exportar en Pdf </a></li>
                        </ul>
                    </div>
                    <div class="input-group input-group-sm" style="display:inline-flex; width: auto;">
                        <label class="input-group-text">Marcas</label>
                        <select class="form-select form-control form-control-sm d-inline brand_select" id="brand_select" name="brand_id" style="width: auto">
                            <option value="" selected>Seleccionar todos</option>
                            @foreach($brands as $brand)
                                @if($brand->id == $brand_id)
                                    <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                @else
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endif
                            {{-- <option value="{{$brand->id}}">{{$brand->name}}</option> --}}
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-lg-7 col-12">
                    <form action="" method="GET">
                        <div class="input-group">
                            <a class="btn btn-outline-secondary btn-sm" href="{{route('vehicles')}}" type="button"><i
                                    class="fa-solid fa-broom"></i></a>
                            <input type="text" class="form-control form-control-sm" name="search"
                                value="{{ old('search') }}" placeholder="Escriba para buscar" required>
                            <button class="btn btn-outline-primary btn-sm" type="submit"><i
                                    class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Marca</th>
                            <th scope="col">N° placa</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($items)==0)
                        <tr class="text-center">
                            <td colspan="4">No se encontraron registros</td>
                        </tr>
                        @else

                        @foreach($items as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->brand->name}}</td>
                            <td>{{$item->number_plate}}</td>
                            <td class="text-center">
                                <a href="{{route('vehicles_edit',['id'=>$item->id])}}"
                                    class="btn btn-light text-success btn-sm" title="Eliminar"><i
                                        class="fa-solid fa-pencil"></i> Editar</a>
                                <button class="btn btn-light text-danger btn-sm delete" data-id="{{$item->id}}"
                                    data-text="{{$item->name}}" type="submit" title="Eliminar"><i
                                        class="fa-solid fa-trash-can"></i>
                                    Eliminar</a>
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip">
                                        {{-- <form action="{{ route('vehicles_delete', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')

                                            <button class="btn btn-light text-danger btn-sm delete"
                                                data-id="{{$item->id}}" data-text="{{$item->name}}" type="submit"
                                                title="Eliminar"><i class="fa-solid fa-trash-can"></i>
                                                Eliminar</a>
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip">
                                        </form> --}}

                            </td>
                        </tr>
                        @endforeach

                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 text-right m-t-10">
                {{ $items->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>

    </div>

</div>
@endsection

@section('js')

<script>
    $(document).ready(function(){
    $(".brand_select").change(function(){
        // alert("The text has been changed.");
        // console.log("hrwerwerwe " + $("#brand_select").val());
        let val_brand_id = $("#brand_select").val();
        if(val_brand_id !== ""){
            window.location.replace("/vehiculos?brand="+val_brand_id);
        }
        else{
            window.location.replace("/vehiculos");
        }        
    });


    $(".delete").on("click", function(){
        let val_id = $(this).attr('data-id');
        let val_text = $(this).attr('data-text');
        var token = $("meta[name='csrf-token']").attr("content");

        swal({
            title: "¿Estás seguro?",
            text: "El registro "+val_text+" será eliminado!",
            icon: "warning",
            buttons: true,
            buttons: ["Cancelar", "Eliminar !"],
            dangerMode: true,
            }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/vehiculos/delete/'+val_id,
                    type: 'POST',
                    data:{
                    '_token': token,
                    '_method': 'DELETE',
                    },
                    success: function(result) {
                        swal("Muy bien!", "Registro eliminado con éxito!", "success");
                        setTimeout(function() { 
                            $(this).attr('disabled', false);
                            window.location.replace("/vehiculos");
                        }, 500);                       
                    },
                    error: function (request, status, error) {
                        console.log(error);            
                    }});
            }})
        });
  });
    
    
    


</script>
@stop