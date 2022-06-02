@extends('templates.layout')

@push('alerts')
    @include('templates.alerts')
@endpush

@section('body')

    <textarea-model></textarea-model>

@endsection