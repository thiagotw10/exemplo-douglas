<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="Audax" />
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-reset.css') ?>" />
        <!--external css-->
        <link href="<?php echo base_url('assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2.min.css') ?>">
        <!--  right slidebar -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slidebars.css') ?>" />
        <!-- Custom styles for this template -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-responsive.css') ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/toastr-master/toastr.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/gritter/css/jquery.gritter.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/bootstrap-fileupload/bootstrap-fileupload.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/table-responsive.css') ?>">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url('assets/js/html5shiv.js') ?>"></script>
          <script src="<?php echo base_url('assets/js/respond.min.js') ?>"></script>
        <![endif]-->        
        {styles}
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
        <script type="text/javascript">
            var CI = {
                'base_url': '<?php echo base_url(); ?>',
                'user': <?= json_encode(['email' => $this->session->userdata('email')
                , 'user' => $this->session->userdata('user'), 'permissoes' => $this->session->userdata('permissoes')])?>
            };
        </script> 
        <style>
            .teste{
                
                background-color: #fff;
                margin-top: 6%;
                border: 1px solid #DADADA;
                box-sizing: border-box;
                border-radius: 5px;
                padding-left: 22px;
                font-weight: 600;
                padding-right: 22px;
                padding-bottom: 4px;
                padding-top: 4px;
            }

            *{
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>

        <section id="container" class="">
            <header class="header white-bg">
                <div class="sidebar-toggle-box menu-sanduich">
                    <div data-original-title="Alternar Navegação" data-placement="right" class="fa fa-bars tooltips"></div>
                </div>
                <a class="logo" href="<?= base_url('Dashboard') ?>" style="font-family: 'Major Mono Display';">CHAD</a>
                <div class="top-nav ">
                    <ul class="nav pull-right top-menu">
                        <li class="dropdown">
                                <div class="teste hidden-xs"><?=$_SESSION['email']?></div>
                        </li>
                    </ul>
                </div>
            </header>
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    {menu}
                </div>
            </aside>
            <section id="main-content">
                <section class="wrapper site-min-height">

                    <?php
                    if (isset($error) && $error) {
                        print '<div class="alert alert-block alert-danger fade in">';
                        print '<h4>';
                        print '<i class="fa fa-ok-sign"></i>';
                        print 'Erro!';
                        print '</h4>';
                        print $error;
                        print '</div>';
                    } else if (isset($success) && $success) {
                        print '<div class="alert alert-block alert-danger fade in">';
                        print '<h4>';
                        print '<i class="fa fa-ok-sign"></i>';
                        print 'Sucesso';
                        print '</h4>';
                        print $success;
                        print '</div>';
                    }
                    ?>

                    {content}
                </section>
            </section>
            <footer class="site-footer">
                <div class="text-center">
                    <?= date("Y") ?> - CHAD &copy; Audax
                    <a href="#" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
        </section>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script class="include" type="text/javascript" src="<?php echo base_url('assets/js/jquery.dcjqaccordion.2.7.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.scrollTo.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.nicescroll.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/respond.min.js') ?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('assets/assets/toastr-master/toastr.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/assets/gritter/js/jquery.gritter.js') ?>"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/locale/pt-br.js"></script>

        <script type="text/javascript" src="<?php echo base_url('assets/js/util.js') ?>"></script>
        <script src="<?= base_url('assets/js/sweetAlert2.min.js') ?>"></script>
        <!--right slidebar-->
        <script type="text/javascript" src="<?php echo base_url('assets/js/slidebars.min.js') ?>"></script>
        <!--common script for all pages-->
        <script type="text/javascript" src="<?php echo base_url('assets/js/common-scripts.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/windows.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/assets/bootstrap-fileupload/bootstrap-fileupload.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/assets/bootstrap-inputmask/bootstrap-inputmask.min.js') ?>"></script>
        <!--<script type="text/javascript" src="<?php echo base_url('assets/js/pagination.js') ?>"></script>-->
        {scripts}
        <script type="text/javascript" src="<?= base_url('assets/js/custom/usuario/anotherDevice.js') ?>"></script>
        <?php if ($this->session->flashdata('anotherDevice')) { ?>
            <script>anotherDevice();</script>
        <?php } ?>  
        <script type="text/javascript">
            setTimeout(function () {
                $(".alert").fadeOut(400);
            }, 3000);


<?php if (isset($data)) { ?>
                $(function () {
                    paginate.create({
                        "limite": "<?= $data['limite'] ?>",
                        "atual": "<?= $data['paginaAtual'] ?>",
                        "paginas": "<?= $data['paginas'] ?>",
                        "campo": "<?= $data['campo'] ?>",
                        "valor": "<?= $data['valor'] ?>",
                        "url": "?action=list"
                    });
                });
<?php } ?>
            $(document).ready(function () {
                $("#upload").on("change", function () {
                    if ($("#upload")[0].files.length > 20) {
                        alert("Você excedeu o número de arquivos. Número máximo 20.");
                        location.reload();
                    }
                });
            });
        </script>
    </body>
</html>
