@extends('layouts.app')

@section('template_title')
    Clip
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h3 class="mb-3">Clip</h3>

                        </div>
                    </div>
                    @can('notas-list')
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>No. recibo</th>
                                            <th>Método de pago</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['results'] as $index => $result)
                                            <tr>
                                                <td>{{ $result['created_at'] }}</td>
                                                <td>{{ $result['receipt_no'] }}</td>
                                                <td>
                                                    <ul>
                                                        <li><strong>Bin:</strong> {{ $result['payment_method']['card']['bin'] }}</li>
                                                        <li><strong>Emisor:</strong> {{ $result['payment_method']['card']['issuer'] }}</li>
                                                        <li><strong>País:</strong> {{ $result['payment_method']['card']['country'] }}</li>
                                                        <li><strong>Últimos dígitos:</strong> {{ $result['payment_method']['card']['last_digits'] }}</li>
                                                        <li><strong>Expiración:</strong> {{ $result['payment_method']['card']['exp_month'] }}/{{ $result['payment_method']['card']['exp_year'] }}</li>
                                                    </ul>
                                                </td>
                                                <td>{{ $result['amount'] }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    @endcan
                </div>

            </div>
        </div>
    </div>
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection


