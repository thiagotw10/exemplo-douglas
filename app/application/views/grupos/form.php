
<section class="panel">
    <header class="panel-heading">
        {title}
    </header>

    <div class="panel-body">
        <form id="form" acceptcharset="UTF-8" method="post" class="cmxform" action="<?php echo base_url('Grupos/save'); ?>" theme="simple" enctype="multipart/form-data">
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
                        <label>Grupos:</label>
                        <div>
                            <?= form_input('nome', $nome, 'class="form-control" autofocus required maxlength="50"'); ?>
                        </div>
                    </div>
                </div>
                

            <br>
            <br>

            <div class="panel-body pull-right">
                <?php
                print '<a href="' . base_url('Grupos') . '" class="btn btn-danger btn-ghost">Cancelar</a>';
                print " &nbsp; ";
                print form_submit('save', 'Salvar', 'class="btn btn-success btn-orange"');
                ?>
            </div>
        </form>

    </div>
</section>