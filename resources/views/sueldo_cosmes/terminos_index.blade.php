@extends('layouts.app')

@section('template_title')
    Terminos Personalizados
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Terminos</h3>

                    <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_terminos" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        Crear terminos
                    </a>

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                        <th>No</th>
                        <th>Usuario</th>
                        <th>titulo</th>
                        <th>firma</th>
                        <th width="280px">Acciones</th>
                        </tr>
                    </thead>

                    @foreach ($custom as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            @if(!isset($item->User->name ))
                                {{ $item->cosmemanual}}
                            @else
                                {{ $item->User->name}}
                            @endif
                        </td>
                        <td>{{ $item->titulo }}</td>
                        <td>
                            @if ($item->firma == NULL)
                                <button class="btn btn-outline-dange disabledr">No ha Firmado</button>
                            @else
                            <img src="{{asset('firmaCosme/'. $item->firma)}}" alt="" style="width: 150px">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('terminos.edit', $item->id) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-signature"></i></a>

                            @if(!isset($item->User->name))
                            <a type="button" class="btn btn-sm" target="_blank"
                            href="https://wa.me/52{{$item->cosmemanual_tel}}?text=Hola%20{{$item->cosmemanual}}%20{{ route('terminos.edit', $item->id) }}"
                            style="background: #00BB2D; color: #ffff">
                            <i class="fa fa-whatsapp"></i>
                            </a>
                            @else
                            <a type="button" class="btn btn-sm" target="_blank"
                            href="https://wa.me/52{{$item->User->photo}}?text=Hola%20{{$item->User->name}}%20{{ route('terminos.edit', $item->id) }}"
                            style="background: #00BB2D; color: #ffff">
                            <i class="fa fa-whatsapp"></i>
                            </a>
                            @endif

                            <a type="button" class="btn btn-sm btn-outline-dark" href="{{ route('treminos.pdf', $item->id) }}">
                                PDF
                            </a>

                            <!-- Botón para eliminar -->
                            <form action="{{ route('terminos.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </table>
                </div>

          </div>
        </div>
      </div>
</div>

@include('sueldo_cosmes.modal_terminoscreate')


@endsection

@section('datatable')
{{-- <script src="https://cdn.tiny.cloud/1/yn4x1viiyko8qn9udqfjn80wby2uece9bv12reo2vvo1h8t2/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
{{-- <script src="https://cdn.tiny.cloud/1/asek5c0zv2gl6pfvxfpzb82en4opov2qjp29rl4jhya2ekls/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
{{-- <script src="https://cdn.tiny.cloud/1/c2jyw7j73gyffzmpqwc1b7o1eaf23c74mn6m4i33evler1u6/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
{{-- <script src="https://cdn.tiny.cloud/1/70r2lcv643j7m3y5n508sflaqhyahwkxavf91e7ftai2zuzt/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
{{-- <script src="https://cdn.tiny.cloud/1/v8yaq9rorvlf4fa7zp00vf83udhkr4qpskoikbk37wqzfsat/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script src="{{ asset('assets/tinymce/tinymce.min.js')}}"></script>

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

    document.addEventListener('DOMContentLoaded', function() {
    var cosmeNoRadio = document.getElementById('cosme_no');
    var cosmeSiRadio = document.getElementById('cosme_si');
    var campoCosmeManual = document.getElementById('campo_cosmemanual');

    function toggleCosmeManualField() {
        if (cosmeSiRadio.checked) {
            campoCosmeManual.style.display = 'flex';
        } else {
            campoCosmeManual.style.display = 'none';
        }
    }

    cosmeNoRadio.addEventListener('change', toggleCosmeManualField);
    cosmeSiRadio.addEventListener('change', toggleCosmeManualField);

    // Llamada inicial para configurar el campo en función del valor predeterminado
    toggleCosmeManualField();

    tinymce.init({
        selector: '#mytextarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
      });


});


</script>

@endsection
