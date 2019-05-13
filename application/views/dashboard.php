
        <div id="page-wrapper">
            <?php if($this->session->flashdata('success')):?>
                &nbsp;<div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $this->session->flashdata('success'); ?></strong>
                </div>
            <?php elseif($this->session->flashdata('error')):?>
                &nbsp;<div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
                </div>
            <?php endif;?>
            <div class="row">
                
                <div class="col-lg-12">
                    <h3 class="page-header">Dashboard</h3>
                    
                </div>
                <div class="col-lg-12">
                   
                    <h3>Numero de usuarios cadastrados: <span class="label label-default"> <?php echo "$totalUsers" ?> </span></h3>
                    <h3>Numero de jogos cadastrados: <span class="label label-default"> <?php echo "$totalJogos" ?> </span></h3>
                        
                
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- wrapper -->
            






