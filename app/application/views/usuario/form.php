
<section class="panel">
    <header class="panel-heading">
        {title}
    </header>

    <div class="panel-body">
        <form id="form" acceptcharset="UTF-8" method="post" class="cmxform" action="<?php echo base_url('Usuario/save'); ?>" theme="simple" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?php
                if (isset($id)) {
                    echo form_hidden('id', $id);
                    echo form_hidden('email_check', $email);
                }

            ?>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nome:</label>
                        <div>
                            <?= form_input('nome', $nome, 'class="form-control" autofocus required maxlength="50"'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>CPF:</label>
                        <div>
                            <?= form_input('cpf', $cpf, 'class="form-control" required autocomplete="off"'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Email:</label>
                        <div>
                            <?= form_input_email('email', $email, 'class="form-control" required autocomplete="off" maxlength="50"'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Senha:</label>
                        <div>
                            <?= form_password('senha', '', 'class="form-control" autocomplete="off"'); ?>
                            <?php if(isset($id)) { echo '<span class="help-inline">* Deixe em branco para manter a senha atual.</span>'; } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Cargos</label>
                        <div>
                        <?= form_dropdown('cargos', $cargos, set_value('cargos', $cargo_id), 'class="form-control"') ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Grupos</label>
                        <div>
                        <?= form_dropdown('grupos', $grupos, set_value('grupos', $grupo_id), 'class="form-control"') ?>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="panel-body pull-right">
                <?php
                print '<a href="' . base_url('Usuario') . '" class="btn btn-danger btn-ghost">Cancelar</a>';
                print " &nbsp; ";
                print form_submit('save', 'Salvar', 'class="btn btn-success btn-orange"');
                ?>
            </div>
        </form>

    </div>
</section>