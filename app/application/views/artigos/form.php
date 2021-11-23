
<section class="panel">
    <header class="panel-heading">
        {title}
    </header>

    <div class="panel-body">
        <form id="form" acceptcharset="UTF-8" method="post" class="cmxform" action="<?php echo base_url('Artigos/save'); ?>" theme="simple" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?php
                if (isset($id)) {
                    echo form_hidden('id', $id);
                    // echo form_hidden('email_check', $email);
                }

            ?>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Usuário:</label>
                        <div>
                            <?= form_input('usuario_id', $this->session->userdata('nome'), 'class="form-control" autofocus required maxlength="50"'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Resumo:</label>
                        <div>
                            <?= form_input('resumo', $resumo, 'class="form-control" required autocomplete="off"'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Texto:</label>
                        <div>
                            <?= form_input('texto', $texto, 'class="form-control" required autocomplete="off" maxlength="50"'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    
                </div>
            </div>

            <hr>

            <div class="panel-body pull-right">
                <?php
                print '<a href="' . base_url('Artigos') . '" class="btn btn-danger btn-ghost">Cancelar</a>';
                print " &nbsp; ";
                print form_submit('save', 'Salvar', 'class="btn btn-success btn-orange"');
                ?>
            </div>
        </form>

    </div>
</section>