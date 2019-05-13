

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
                    <table class="table table-striped table-bordered table-hover" id="dataTables-games-list">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Jogo</th>
                                <th>Desenvolvedora</th>
                                <th>Publisher</th>
                                <th>Plataforma</th>
                                
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $null = "null"; foreach($games  as $row): ?>
                            <tr>
                                <td><?php echo $row->jogo_id; ?></td> 
                                <td><?php echo $row->nome; ?></td> 
                                <td><?php echo $row->desenvolvedora; ?></td>
                                <td><?php echo $row->publisher; ?></td> 
                                <td><?php echo $row->plataforma; ?></td> 
                                <td>
                                    <a class="btn btn-primary" id="game-edit"  onclick="editar_jogo_popup('<?=$row->jogo_id?>','<?=$row->nome?>','<?=$row->plataforma?>','<?=$row->desenvolvedora?>','<?=$row->dev_id?>','<?=$null?>','<?=$null?>');" data-toggle="modal" data-target="#editarGame"> Editar </a>
                                    <a class="btn btn-danger" id="game-delete" onclick="desativaGame('<?=$row->nome?>','<?=$row->jogo_id?>');" data-toggle="modal" data-target="#deactivateConfirm"> Deletar </a>
                                    
                                </td>

                            </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>

                    <div class="col-lg-12" style="position:fixed;bottom: 5%;left: 88%; width: 150px;text-align: center;border-radius: 100%;">
                        <img class="create_usuario" src="<?=base_url()?>assets/images/add.png" data-toggle="modal" data-target="#addGame" />
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
                        <label>Você está deletando o Jogo <label id="jogo-mensagem" style="color:blue;"></label>.</label><br/>
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




        <div class="modal fade" id="addGame" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-blue">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Novo jogo</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden"  id="edit-user-id" value=""/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label> &nbsp;&nbsp;
                                    <label class="error" id="error-new-jogo"> Campo Obrigatorio</label>
                                    <label class="error" id="error-new-jogo2"> O nome deve ser alphanumerico</label>
                                    <input class="form-control" id="njogo" placeholder="Jogo" name="njogo" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                    <label>Desenvolvedor</label>&nbsp;&nbsp;
                                    
                                     <?php 
                                       

                                        
                                     ?>
                                    <label class="error" id="new-error_desenvolvedora"> Campo Obrigatorio</label>
                                    <input  name="dev_id" id="dev_id" type="hidden" value="">
                                    <select name="new_desenvolvedora" id="new_desenvolvedora" class="form-control" >
                                    
                                        <?php   foreach($desenvolvedoras as $row): ?>
                                            <option value="<?php echo $row->id ?>"> <?php echo $row->nome;?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                    <label>Publisher</label>&nbsp;&nbsp;
                                    <label class="error" id="new-error_publishers"> Campo Obrigatorio</label>
                                    <select name="new_publishers" id="new_publishers" class="form-control" >
                                        <?php   foreach($publishers as $row): ?>
                                            <option value="<?php echo $row->id ?>"> <?php echo $row->nome ?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                </div>
                            </div>
                                
                      </div>
                      <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Plataformas</label>&nbsp;&nbsp;
                                    <label class="error" id="new-error_plataformas"> Campo Obrigatorio</label>
                                    <select name="new_plataformas" id="new_plataformas" class="form-control" >
                                        <?php   foreach($plataformas as $row): ?>
                                            <option value="<?php echo $row->id ?>"> <?php echo $row->nome ?></option>
                                        <?php endforeach; ?>
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


        <div class="modal fade" id="editarGame" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-blue">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Atualizar Jogo</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden"  id="edit-jogo-id" value=""/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label> &nbsp;&nbsp;
                                    <label class="error" id="error-edit-jogo"> Campo Obrigatorio</label>
                                    <label class="error" id="error-edit-jogo2"> O nome deve ser alphanumerico</label>
                                    <input class="form-control" id="edit-jogo" placeholder="Jogo" name="edit-jogo" type="text" autofocus>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                    <label>Desenvolvedor</label>&nbsp;&nbsp;
                                    
                                     <?php 
                                       

                                        
                                     ?>
                                    <label class="error" id="edit-error_desenvolvedora"> Campo Obrigatorio</label>
                                    <input  name="dev_id" id="dev_id" type="hidden" value="">
                                    <select name="desenvolvedora" id="edit-desenvolvedora" class="form-control" >
                                    
                                        <?php   foreach($desenvolvedoras as $row): ?>
                                            <option value="<?php echo $row->id ?>"> <?php echo $row->nome;?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                    <label>Publisher</label>&nbsp;&nbsp;
                                    <label class="error" id="edit-error_publishers"> Campo Obrigatorio</label>
                                    <select name="publishers" id="edit-publishers" class="form-control" >
                                        <?php   foreach($publishers as $row): ?>
                                            <option value="<?php echo $row->id ?>"> <?php echo $row->nome ?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                </div>
                            </div>
                                
                      </div>
                      <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Plataformas</label>&nbsp;&nbsp;
                                    <label class="error" id="edit-error_plataformas"> Campo Obrigatorio</label>
                                    <select name="plataformas" id="edit-plataformas" class="form-control" >
                                        <?php   foreach($plataformas as $row): ?>
                                            <option value="<?php echo $row->id ?>"> <?php echo $row->nome ?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                </div>
                            </div>
                      </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="editarJogoSubmit" type="button" class="btn btn-primary">Atualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
       
        <!-- /#page-wrapper -->
        <?php $this->load->view('frame/footer_view')?>
        <script src="<?=base_url()?>assets/js/view/games_list_admin.js"></script>