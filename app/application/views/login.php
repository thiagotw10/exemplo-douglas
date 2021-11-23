<?php

if (isset($error) && $error) {
    print '<div class="alert alert-block alert-danger fade in">';
    print '<h4>';
    print '<i class="fa fa-ok-sign"></i>';
    print 'Erro!';
    print '</h4>';
    print $error_msg;
    print '</div>';
}

if (isset($already_installed) && $already_installed) {
    print "O sistema foi instalado com sucesso.";
} else {
    if (isset($already_installed) && !$already_installed) {
        echo form_open('install/run', array('class' => 'form-signin'));
    } else {
        echo form_open('login/validate', array('class' => 'form-signin'));
    }

    print '<h2 class="form-signin-heading">CHAD</h2>';
    print '<div class="login-wrap">';

    print form_input_email('email', $email, 'class="form-control" placeholder="Usuário" autofocus autocomplete="off"');
    print form_password('senha', $senha, 'class="form-control" placeholder="Senha"');

    if (isset($already_installed) && !$already_installed) {
        print form_submit('install', 'Criar Usuário', 'class="btn btn-lg btn-login btn-block btn-login"');
    } else {
        print form_submit('login', 'Acessar', 'class="btn btn-lg btn-login btn-block btn-login"');
    }

    print '</div>';
    print form_close();
}
