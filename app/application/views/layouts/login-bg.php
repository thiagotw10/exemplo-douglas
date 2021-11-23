<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="S'tos App" />
        <title>{title}</title>

        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('assets/img/icon/apple-icon-57x57.png') ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('assets/img/icon/apple-icon-60x60.png') ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/img/icon/apple-icon-72x72.png') ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/icon/apple-icon-76x76.png') ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/img/icon/apple-icon-114x114.png') ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('assets/img/icon/apple-icon-120x120.png') ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('assets/img/icon/apple-icon-144x144.png') ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/img/icon/apple-icon-152x152.png') ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/img/icon/apple-icon-180x180.png') ?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url('assets/img/icon/android-icon-192x192.png') ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/img/icon/favicon-32x32.png') ?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/img/icon/favicon-96x96.png') ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/img/icon/favicon-16x16.png') ?>">
        <link rel="manifest" href="<?php echo base_url('assets/img/icon/manifest.json') ?>">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo base_url('assets/img/icon/ms-icon-144x144.png') ?>">
        <meta name="theme-color" content="#373435">

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/bootstrap-reset.css') ?>" rel="stylesheet" />
        <!--external css-->
        <link href="<?php echo base_url('assets/assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
        <!--  right slidebar -->
        <link href="<?php echo base_url('assets/css/slidebars.css') ?>" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/style-responsive.css') ?>" rel="stylesheet" />
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url('assets/js/html5shiv.js') ?>"></script>
          <script src="<?php echo base_url('assets/js/respond.min.js') ?>"></script>
        <![endif]-->
        {styles}
        <style>
            body{
                background-image: url(<?= base_url('assets/img/bg-login.jpg')?>);
                background-repeat: no-repeat;
                background-size: cover;
                height: 100vh;
            }
        </style>
        <script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>
    </head>
    <body class="login-body">
        <div class="container">
            {content}
        </div>
        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        {scripts}

        <script type="text/javascript">
            setTimeout(function () {
                $(".alert").fadeOut(400);
            }, 3000);
        </script>

    </body>
</html>
