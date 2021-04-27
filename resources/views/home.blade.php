@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Sistema de chamados ABSX - RIZER
                </div>

                <div class="row">
                    <div class="col-md-4 card-body d-flex justify-content-center text-center">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <a href="/crud-chamado">
                            Administrar chamados
                        </a>
                    </div>
                    <div class="col-md-4 card-body d-flex justify-content-center text-center">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <a href="/cadastro-vendedor">
                            Administrar vendedores
                        </a>
                    </div>
                    <div class="col-md-4 card-body d-flex justify-content-center text-center">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <a href="/cadastro-chamado">
                            Criar novo chamado
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection