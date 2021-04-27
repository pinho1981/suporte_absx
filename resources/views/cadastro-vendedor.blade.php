<?php
    use App\Models\Vendedor;
?>

@extends('layouts.app')

@section('content')
@if (@auth::check())
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<script src="{{ asset('js/script.js') }}" defer></script>

<script>
jQuery(document).ready(function() {
    $(document).on('click', '.edit', function() {
        $('#id_form').val($(this).data('id'));
        $('#id_nome').val($(this).data('nome'));
        $('#id_email').val($(this).data('email'));
        $('#id_status').val($(this).data('status'));
        $('#id_telefone').val($(this).data('telefone'));
        $('#id_chamados_abertos').val($(this).data('chamados_abertos'));
        $('#id_chamados_em_atendimento').val($(this).data('chamados_em_atendimento'));
        $('#id_chamados_resolvidos').val($(this).data('chamados_resolvidos'));
    });
    $(document).on('click', '.delete', function() {
        $('#id_form_delet').val($(this).data('id'));
        $('.email_user_delet').text($(this).data('email'));
    });
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function() {
        if (this.checked) {
            checkbox.each(function() {
                this.checked = true;
            });
        } else {
            checkbox.each(function() {
                this.checked = false;
            });
        }
    });
    checkbox.click(function() {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
});
</script>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gerenciar vendedores</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                            Adicionar vendedor
                        </a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Telefone</th>
                        <th>Abertos</th>
                        <th>Atendimento</th>
                        <th>Resolvidos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $vendedores = Vendedor::all();
                   if (!empty($vendedores)){
                       foreach ($vendedores as $vendedor){
                           echo ("<tr>
                            </td>
                            <td>".$vendedor->nome."</td>
                            <td>".$vendedor->email."</td>
                            <td>".$vendedor->status."</td>
                            <td>".$vendedor->telefone."</td>
                            <td>".$vendedor->chamados_abertos."</td>
                            <td>".$vendedor->chamados_em_atendimento."</td>
                            <td>".$vendedor->chamados_resolvidos."</td>
                            <td>
                            <a href=/meus-chamados/".$vendedor->id." class='vendedor'></a>
                            <a href='#editEmployeeModal' class='edit' data-toggle='modal'
                                data-id=".$vendedor->id."
                                data-nome=".$vendedor->nome."
                                data-email=".$vendedor->email."
                                data-status=".$vendedor->status."
                                data-telefone=".$vendedor->telefone."
                                data-chamados_abertos=".$vendedor->chamados_abertos."
                                data-chamados_em_atendimento=".$vendedor->chamados_em_atendimento."
                                data-chamados_resolvidos=".$vendedor->chamados_resolvidos.">
                            Alterar
                            </a>
                            <a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id=".$vendedor->id." data-email=".$vendedor->email.">Apagar</a>
                        </td>");
                       }
                   }
                   ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/post-vendedor" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar vendedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input placeholder="Nome" type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input placeholder="E-mail" type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input placeholder="Telefone" class="form-control" name="telefone" required></input>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select  class="form-control" name="status"  required>>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="chamados_abertos" value="0">
                    <input type="hidden" name="chamados_em_atendimento" value="0">
                    <input type="hidden" name="chamados_resolvidos"  value="0">
                    <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Adicionar">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="/update-vendedor" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-header">
                    <h4 class="modal-title">Alterar vendedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                            <input type="hiden" name="id" id="id_form" class="form-control" required>
                        </div>
                    <div class="form-group">
                        <input placeholder="Nome" type="text" name="nome" id="id_nome" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input placeholder="E-mail" type="email" name="email" id="id_email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input placeholder="Telefone" class="form-control" name="telefone" id="id_telefone" required></input>
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <select  class="form-control" name="status" id="id_status" required>>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chamados em aberto:</label>
                        <input type="text" name="chamados_abertos" id="id_chamados_abertos" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Chamados em andamento:</label>
                        <input type="text" name="chamados_em_atendimento" id="id_chamados_em_atendimento" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Chamados resolvidos:</label>
                        <input type="text" name="chamados_resolvidos" id="id_chamados_resolvidos" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Salvar">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/delete-vendedor" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Apagar vendedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id_form_delet" class="form-control" required>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </div>
                    <p>Deseja apagar o vendedor <span class="email_user_delet" /></span>?</p>
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