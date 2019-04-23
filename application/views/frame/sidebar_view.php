            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu"><br>
                        <li>
                        <img style="display: block; margin-right: auto;  margin-left: auto;" width="45%" padding="90px" class="img-thumbnail" src="<?php echo $this->session->userdata('url_img'); ?>"/>
                            <?php echo '<p class="welcome"><b> <text style="font-size:150%;">&#9786</text> <i>Bem vindo </i>' . $this->session->userdata('nome') . "!</b></p>" ?>
                        </li>

                        

                        <li>
                            <a href="<?=base_url()?>"><i class="fa fa-home fa-fw"></i> Painel de Controle</a>
                        </li>
                        <?php if($this->session->userdata('grupo') == 'admin'): ?>
                            <li>
                                <a href="#"><i class="fa fa-user fa-fw"></i> Administrador<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li> <a href="<?=base_url('admin/user_list')?>">&raquo; Listar Usuarios</a> </li>
                                    <li> <a href="<?=base_url('admin/log_atv')?>">&raquo; Activity Log</a> </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Other Menu Sample<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li> <a href="#">&raquo; Menu exemplo 2</a> </li>
                                <li> <a href="#">&raquo; Menu exemplo 2</a> </li>
                            </ul>
                        </li>
                  
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>