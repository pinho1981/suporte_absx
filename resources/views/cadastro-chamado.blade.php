<?php use App\Models\Vendedor;?>
@extends('layouts.app')

@section('content')
<?php $vendedores = Vendedor::All()->count(); ?>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<script src="{{ asset('js/script.js') }}" defer></script>

@if($vendedores == '0')
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Tente novamente</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else                
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Adicionar chamado</h2>
                    </div>
                </div>
            </div>
            <form action="/post-chamado" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="status" value="aberto"><br /><br />
                <div class="form-group">
                    <input class="form-control" type="text" name="assunto" placeholder="Assunto">
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição"  rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
