<div class="panel panel-danger">
      <div class="panel-heading">Erro ao tentar cadastrar um usuário</div>
      <div class="panel-body">
         <p> Outro usuário já está cadastrado com esse email. </p>
         <button class="btn btn-warning" onclick="voltar()">Voltar</button>
      </div>
</div>
<script>
    function voltar(){
        window.history.go(-1);
    }
</script>