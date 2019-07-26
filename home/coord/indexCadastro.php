
<?php 
include("../../login/check.php");
require_once('functions.php');

include(HEADER_TEMPLATE);
include(HEADER_MENU);
?>

<div class="board">

  <div class="board-header m-2 p-3 row align-items-center">
    <div class="board-titulo col-12 p-0">
      <h1 class="font-weight-bold">Cadastrar Usuário</h1>
    </div>
  </div>

  <div class="board-body m-2 p-3" id="bodyCadastro">
    <form action="cadastro.php" method="POST" class="needs-validation p-3 w-50" id="formCadastro" novalidate>

      <div class="row p-0">
        <div class="form-group col-6">
          <label for="nome" class="font-weight-bold">Nome:</label>
          <input type="text" class="form-control" id="nome" placeholder="Digite o nome" name="nome" required>
          <div class="valid-feedback">Válido.</div>
          <div class="invalid-feedback">Por favor preencha este campo.</div>
        </div>

        <div class="form-group col-6">
          <label for="snome" class="font-weight-bold">Sobrenome:</label>
          <input type="text" class="form-control" id="snome" placeholder="Digite o sobrenome" name="snome" required>
          <div class="valid-feedback">Válido.</div>
          <div class="invalid-feedback">Por favor preencha este campo.</div>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-6">
          <label for="id" class="font-weight-bold">Matrícula SIAPE:</label>
          <input type="number" min="0" max="9999999" class="form-control" id="id" placeholder="Digite a matricula SIAPE" name="id" required>
          <div class="valid-feedback">Válido.</div>
          <div class="invalid-feedback" id="id-feedback">Por favor preencha este campo.</div>
        </div>
        <div class="form-group col-6">
          <label for="permissao" class="font-weight-bold">Cargo:</label>
          <select class="form-control" id="permissao" name="permissao">
            <option value="1">Professor(a)</option>
            <option value="2">Coordenador(a)</option>
            <option value="3">Técnico(a)</option>
          </select>
        </div>
      </div>

<!--       <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input active" id="optProfessor" name="permissao" value="1">
        <label class="custom-control-label" for="optProfessor">Professor</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="optCoordenador" name="permissao" value="2">
        <label class="custom-control-label" for="optCoordenador">Coordenador</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="optTecnico" name="permissao" value="3">
        <label class="custom-control-label" for="optTecnico">Tecnico</label>
      </div> -->

      <div class="row">
        <div class="form-group col-6">
          <label for="id" class="font-weight-bold">Senha:</label>
          <input type="password" class="form-control" id="senha" placeholder="Digite uma senha" name="senha" required>
          <div class="valid-feedback">Válido.</div>
          <div class="invalid-feedback">Por favor preencha este campo.</div>
        </div>
        <div>
          <div class="col-6"></div>
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </form>
    
  </div>


</div>



<script>
  (function() {
    'use strict';
    window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
  })();
</script>

<?php 
include(FOOTER_TEMPLATE);
?>