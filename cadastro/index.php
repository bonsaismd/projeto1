
<?php 
require_once('../config.php');
require_once(DBAPI);
include(HEADER_TEMPLATE);
?>

<h2>Novo usuário</h2>
<hr>

<form action="cadastro.php" method="POST" class="needs-validation" novalidate>

  <div class="form-group">
    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required>
    <div class="valid-feedback">Válido.</div>
    <div class="invalid-feedback">Estou muito triste você não me viu??? Por favor preencha este campo.</div>
  </div>

  <div class="custom-control custom-radio custom-control-inline">
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
  </div>

  <br><br>
  <div class="form-group">
    <input type="text" class="form-control" id="id" placeholder="ID" name="id" required>
    <div class="valid-feedback">Válido.</div>
    <div class="invalid-feedback" id="id-feedback">Estou muito triste você não me viu??? Por favor preencha este campo.</div>
  </div>

  <div class="form-group">
    <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha" required>
    <div class="valid-feedback">Válido.</div>
    <div class="invalid-feedback">Estou muito triste você não me viu??? Por favor preencha este campo.</div>
  </div>

  <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

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