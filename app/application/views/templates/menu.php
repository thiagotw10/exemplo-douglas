
<style>
.imgIcon{
    align-items: center;
    display: flex;
}
</style>

<ul class="sidebar-menu" id="nav-accordion">

    <li>
        <a href="<?php echo base_url('Dashboard'); ?>" <?= $controller == "Dashboard" ? "class='active'" : "" ?>>
            <img src="<?=base_url('/assets/img/dash.png')?>" class="img-icon">
            <span>Dashboard</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url('Usuario'); ?>" <?= $controller == "Usuario" ? "class='active'" : "" ?>>
            <img src="<?=base_url('/assets/img/usuarioiten.png')?>" class="img-icon">
            <span>Usuários</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url('Artigos'); ?>" <?= $controller == "Artigos" ? "class='active'" : "" ?>>
            <div class="imgIcon"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-license" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9e9e9e" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" />
  <line x1="9" y1="7" x2="13" y2="7" />
  <line x1="9" y1="11" x2="13" y2="11" />
</svg>
<span>Artigos</span>
</div>
        
        </a>
    </li>

    <li>
        <a href="<?php echo base_url('Cargos'); ?>" <?= $controller == "Cargos" ? "class='active'" : "" ?>>
            <div class="imgIcon"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9e9e9e" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <rect x="3" y="7" width="18" height="13" rx="2" />
  <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
  <line x1="12" y1="12" x2="12" y2="12.01" />
  <path d="M3 13a20 20 0 0 0 18 0" />
</svg>
<span>Cargos</span>
</div>
        
        </a>
    </li>



    <li>
        <a href="<?php echo base_url('Login/logout'); ?>">
        <img src="<?=base_url('/assets/img/aouticon.png')?>" class="img-icon">
            <span>Sair</span>
        </a>
    </li>
</ul>
