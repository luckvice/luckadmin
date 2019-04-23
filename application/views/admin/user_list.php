

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><?=$title?></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $this->session->flashdata('success'); ?></strong>
                </div>
            <?php elseif($this->session->flashdata('error')):?>
                <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
                </div>
            <?php endif;?>
            <div class="row">
                <div class="col-lg-12">      
                    <table class="table table-striped table-bordered table-hover" id="dataTables-user-list">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Grupo</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users  as $row): ?>
                            <tr>
                                <td><?php echo $row->nome; ?></td> 
                                <td><?php echo $row->email; ?></td>
                                <td><?php echo ucfirst($row->grupo) ?></td> 
                                
                                <td>
                                    <a class="btn btn-primary" id="user-edit"  onclick="editar_usuario_popup('<?=$row->email?>','<?=$row->user_id?>','<?=$row->nome?>','<?=$row->grupo?>','<?=$row->url_img?>');" data-toggle="modal" data-target="#editarUsuario"> Editar </a>
                                    <a class="btn btn-warning" id="user-riset" onclick="reset_confirmation('<?=$row->email?>','<?=$row->user_id?>')" data-toggle="modal" data-target="#resetConfirm"> Resetar Senha </a>
                                    <a class="btn btn-danger" id="user-delete" onclick="deactivate_confirmation('<?=$row->email?>','<?=$row->user_id?>');" data-toggle="modal" data-target="#deactivateConfirm"> Deletar </a>
                                    
                                </td>

                            </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>

                    <div class="col-lg-12" style="position:fixed;bottom: 5%;left: 88%; width: 150px;text-align: center;border-radius: 100%;">
                        <img class="create_usuario" src="<?=base_url()?>assets/images/add.png" data-toggle="modal" data-target="#addUser" />
                    </div>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>



        <!-- Modal -->
        <div class="modal fade" id="deactivateConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-red">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Dialogo de confirmação</h4>
                    </div>
                    <div class="modal-body">
                        <label>Você está deletando o usuario <label id="user-email" style="color:blue;"></label>.</label><br/>
                        <label>Clique em  <b>Sim</b> Para continuar.</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <a id="deactivateYesButton" class="btn btn-danger" >Sim</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Modal -->
        <div class="modal fade" id="resetConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-red">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Confirmação de reset de senha</h4>
                    </div>
                    <div class="modal-body">
                        <label>Você esta resetando a senha de <label id="reset-user-email" style="color:blue;"></label></label><br/>
                        <label>Um e-mail temporario com uma senha gerada pelo sistema será enviado para: <label id="reset-user-email" style="color:blue;"></label></label><br/>
                        <label>Clique em <b>Sim</b> para continuar.</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <a id="resetYesButton" class="btn btn-warning" >Sim</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->




        <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-blue">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Criar novo usuario</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label> &nbsp;&nbsp;
                                    <label class="error" id="error_nome"> Campo Obrigatorio</label>
                                    <label class="error" id="error_nome2"> O nome deve ser alphanumerico</label>
                                    <input class="form-control" id="nome" placeholder="Nome" name="nome" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>E-mail</label> &nbsp;&nbsp;
                                    <label class="error" id="error_email"> Campo Obrigatorio</label>
                                    <label class="error" id="error_email2"> esse e-mail ja existe.</label>
                                    <label class="error" id="error_email3"> e-mail inválido.</label>
                                    <input class="form-control" id="email" placeholder="E-mail" name="email" type="email" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Imagem avatar url</label> &nbsp;&nbsp;
                                    <label class="error" id="edit_img"> Campo Obrigatorio</label>
                                    <input class="form-control" id="url_img" placeholder="img" name="url_img" type="text" autofocus>
                                </div> 
                            </div>  
                      </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Grupo</label>&nbsp;&nbsp;
                                    <label class="error" id="error_grupo"> Campo Obrigatorio</label>
                                    <select name="grupo" id="grupo" class="form-control" >
                                        <option value="0" selected="selected">-- Selecionar grupo --</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select> 
                                </div>
                            </div>
                      </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="newUserSubmit" type="button" class="btn btn-primary">Criar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        <div class="modal fade" id="editarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-blue">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Atualizar detalhes de usuário</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden"  id="edit-user-id" value=""/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label> &nbsp;&nbsp;
                                    <label class="error" id="error-editarNomeUsuario"> Campo Obrigatorio</label>
                                    <label class="error" id="error-editarNomeUsuario2"> O nome deve ser alphanumerico</label>
                                    <input class="form-control" id="edit-nome" placeholder="Name" name="edit-nome" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>-Email</label> &nbsp;&nbsp;
                                    <label class="error" id="edit-error_email"> Campo Obrigatorio</label>
                                    <label class="error" id="edit-error_email2"> estge e-mail ja existe.</label>
                                    <label class="error" id="edit-error_email3"> E-mail inválido.</label>
                                    <input class="form-control" id="edit-email" placeholder="E-mail" name="edit-email" type="email" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Imagem avatar url</label> &nbsp;&nbsp;
                                    <label class="error" id="edit_img-error"> Campo Obrigatorio</label>
                                    <input class="form-control" id="edit_img" placeholder="img" name="edit_img" type="text" autofocus>
                                </div> 
                            </div>      
                      </div>
                      <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Grupo</label>&nbsp;&nbsp;
                                    <label class="error" id="edit-error_grupo"> Campo Obrigatorio</label>
                                    <select name="grupo" id="edit-grupo" class="form-control" >
                                    </select> 
                                </div>
                            </div>
                      </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="editarUsuarioSubmit" type="button" class="btn btn-primary">Atualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
       
        <!-- /#page-wrapper -->
        <?php $this->load->view('frame/footer_view')?>
        <script src="<?=base_url()?>assets/js/view/user_list.js"></script>