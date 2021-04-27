<?php
    use App\Models\Chamado;
    use App\Models\Vendedor;
?>

@extends('layouts.app')

@section('content')
@if (@auth::check())
<?php
    $vendedores = Vendedor::All()->count();
?>

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<script src="{{ asset('js/script.js') }}" defer></script>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gerenciar chamados</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addChamadoModal" class="btn btn-success" data-toggle="modal">
                            <span>Criar Chamado</span>
                        </a>                        
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Assunto</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Data / hora da criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $chamados = Chamado::all();
                        if (!empty($chamados)){
                            foreach ($chamados as $chamado){
                                echo ("<tr>
                                <td>".$chamado->assunto."</td>
                                <td>".$chamado->descricao."</td>
                                <td>".$chamado->status."</td>
                                <td>".date('d/m/Y H:i:s' , strtotime($chamado->created_at)) . "</td>
                                <td>
                                    <a href='#editChamadoModal' class='edit' data-toggle='modal'
                                        data-id=".$chamado->id."
                                        data-assunto=".$chamado->assunto."
                                        data-status=".$chamado->status."
                                        data-descricao=".$chamado->descricao."
                                        data-created_at=".$chamado->created_at."
                                    >Alterar</a>
                                    <a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id=".$chamado->id.">
                                    Apagar</a>
                                </td>");
                            }
                        }
                   ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
@if($vendedores == '0')

<div id="addChamadoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/post-chamado" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-header">
                    <h4 class="modal-title">Tente novamente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    
                </div>
        </div>
                <div class="modal-footer">                   
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">         
                </div>
            </form>
        </div>
    </div>
</div>
@else   

<div id="addChamadoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/post-chamado" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-header">
                    <h4 class="modal-title">Novo Chamado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <input placeholder="Assunto" type="text" name="assunto" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Descrição" rows="10" name="descricao" class="form-control"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="status" value="aberto">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Adicionar">
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<div id="editChamadoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/update-chamado" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-header">
                    <h4 class="modal-title">Alterar chamado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hiden" name="id" id="id_form" class="form-control" required style="display: none">                        
                        <input placeholder="Assunto" type="text" name="assunto" id="id_assunto" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Descrição" rows="10" name="id_descricao" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <select  class="form-control" name="status" id="id_status" required>>
                            <option value="Aberto">Aberto</option>
                            <option value="Atrasado">Atrasado</option>
                            <option value="Atendimento">Atendimento</option>
                            <option value="Resolvido">Resolvido</option> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Data de criação:</label>
                        <input type="text" name="created_at" id="id_created_at" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn btn-primary" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Salvar">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/delete-chamado" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Apagar chamado</h4>                    
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <input type="hidden" name="id" id="id_form_delet" class="form-control" required>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </div>
                    <p>Apagar esse chamado?</p>                    
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-danger" value="Apagar">
                </div>
            </form>
        </div>
    </div>
</div>
@else  <script>window.location = "/login";</script>
@endif
@endsection