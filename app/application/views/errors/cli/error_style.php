<div class="panel panel-danger">
      <div class="panel-heading"><?= $title ?></div>
      <div class="panel-body">
         <p><?= $msg ?></p>
         <button class="btn btn-warning" onclick="voltar()">Voltar</button>
      </div>
</div>

<script>
    function voltar(){
        window.history.go(-1);
    }
</script>