<?= form_consulta(base_url('Artigos'), ['resumo' => 'Resumo'], $c_campo, $c_valor, $c_limite, "Pesquisar os artigos"); ?>

<section class="panel">
    <header class="panel-heading">Registros</header>

    <div class="panel-body pull-right">
        <a class="btn btn-primary btn-orange" href="<?php echo base_url('Artigos/add/'); ?>">
            <i class="fa fa-plus"></i> 
            Adicionar Artigos
        </a>
    </div>

    <div id="unseen" class="panel-body">
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Resumos</th>
                    
                    <th class="col-lg-1 text-right">A&ccedil;&otilde;es</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($artigos)) {
                    foreach ($artigos as $entity) {
                        print "<tr>";
                        print "<td>" . $entity["resumo"] . "</td>";
                        
                        print '<td class="text-right">';
                        print '<a class="img-icon" href="'. base_url('Artigos/edit/' . $entity['id']) .'"><img src="'.base_url('/assets/img/editar.png').'" style="width: 30px;"></a>';
                        print ' ';
                        print ' ';
                        print '<a onclick="okDelete('. $entity['id'] .');" class="img-icon"><img src="'.base_url('/assets/img/excluir.png').'"></a>';
                        print '</td>';

                        print '</tr>';
                    }
                } else {
                    print "<tr><td colspan='3'>Nenhum registro encontrado</td></tr>";
                }
                ?>

            </tbody>
        </table>
        
    </div>

    <?= form_pagination(base_url('Artigos'), $c_valor, $c_campo, $c_limite, $c_paginas, $c_paginaAtual) ?>
</section>
