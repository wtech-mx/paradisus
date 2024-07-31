@extends('layouts.app')

@section('breadcrumb')
<div class="row">
    <div class="col-lg-12">
        <div class="card  mb-4">
            <div class="card-body p-3">

                @include('alerts.disponibilidad')

            </div>
        </div>
    </div>
  </div>
@endsection

@section('content')
    {{--calednarioi--}}
    @include('alerts.calendar');
    {{--calednarioi--}}
@endsection
