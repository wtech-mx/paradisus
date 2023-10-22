@extends('layouts.app')

@section('template_title')
    Encuestas Satisfacion
@endsection
<style>
    .carousel-text {
    overflow: hidden;
    height: 1.5em; /* Altura máxima para mostrar un párrafo a la vez */
}

.carousel-text p {
    margin: 0;
    padding: 0;
    opacity: 0;
    transition: opacity 1s;
    display: none;
}

.carousel-text p.active {
    opacity: 1;
    display: block;
}

.carousel-badge .badge {
    display: none;
}

.carousel-badge .badge.active {
    display: inline-block;
}
</style>
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <form action="{{ route('advance_search.encuestas') }}" method="GET" >

                    <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                        <h6>Filtros</h6>
                            <div class="row">
                                <div class="col-3 ml-3">
                                    <label class="form-label">Del</label>
                                    <div class="input-group">
                                        <input name="fecha" class="form-control"
                                            type="date" required value="{{$fechaActual}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Al</label>
                                    <div class="input-group">
                                        <input  name="fecha2" type="date" class="form-control" required value="{{$fechaActual}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <br>
                                    <button class="btn btn-sm bg-success mb-0 mt-sm-0 mt-1" type="submit" style="color: #ffffff;">Buscar</button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>

            <div class="card mt-5">
                @if(Route::currentRouteName() != 'index.encuestas')
                    @include('encuestas.vista_admin.dos_graficas')
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

@section('datatable')

<script type="text/javascript">
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      deferRender:true,
      paging: true,
      pageLength: 10
    });

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
      deferRender:true,
      paging: true,
      pageLength: 10
    });

    const dataTableSearch3 = new simpleDatatables.DataTable("#datatable-search3", {
      deferRender:true,
      paging: true,
      pageLength: 10
    });

    const dataTableSearch4 = new simpleDatatables.DataTable("#datatable-search4", {
      deferRender:true,
      paging: true,
      pageLength: 10
    });


</script>

@endsection
