@extends('layouts.app')

@section('breadcrumb')
<div class="row">
    <div class="col-lg-12">
        <div class="card  mb-4">
            <div class="card-body p-3">

            </div>
        </div>
    </div>
  </div>
@endsection

@section('content')
    {{--calednarioi--}}
    @include('alerts.calendar_anterior');
    {{--calednarioi--}}
@endsection
