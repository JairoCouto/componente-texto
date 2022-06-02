@extends('templates.layout')

@push('alerts')
    @include('templates.alerts')
@endpush

@section('body')
    <div class="card">
        <div class="card-header">
            Modelo - Final
        </div>
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <input type="hidden" name="id_edital_enviado" value="{{ isset($editalSend->id_edital_enviado) ? $editalSend->id_edital_enviado : '' }}">

                <textarea id="componente" name="componente" class="form-control">{{ isset($editalSend->texto_edital) ? $editalSend->texto_edital : ''  }}</textarea>
    
                <br/>
    
            </form>
        </div>
    </div>

    
@endsection

