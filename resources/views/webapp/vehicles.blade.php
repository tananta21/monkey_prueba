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
                <div class="col-lg-6 col-12">
                    <a class="btn btn-secondary btn-sm" href="{{route('vehicles')}}"><i class="fa-solid fa-rotate"></i></a>
                    <div class="dropdown d-inline">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Acciones
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Exportar Pdf</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Escriba para buscar">
                            <button class="btn btn-outline-primary btn-sm" type="button">Buscar</button>
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
                                <button class="btn btn-light text-success btn-sm" title="Eliminar"><i
                                        class="fa-solid fa-pencil"></i> Editar</button>
                                <button class="btn btn-light text-danger btn-sm" title="Eliminar"><i
                                        class="fa-solid fa-trash-can"></i> Eliminar</button>
                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip">
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