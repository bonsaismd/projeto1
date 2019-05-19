<?php
require_once('functions.php');
add();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Novo usuário</h2>
<hr>

<form action="/add.php" class="needs-validation" novalidate>
  <div class="form-group">
    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required>
    <div class="valid-feedback">Válido.</div>
    <div class="invalid-feedback">Estou muito triste você não me viu??? Por favor preencha este campo.</div>
  </div>
  <div class="form-check-inline">
    <label class="form-check-label">
      <input type="radio" class="form-check-input" name="optradio">Professor
    </label>
  </div>
  <div class="form-check-inline">
    <label class="form-check-label">
      <input type="radio" class="form-check-input" name="optradio">Coordenador
    </label>
  </div>
  <div class="form-check-inline">
    <label class="form-check-label">
      <input type="radio" class="form-check-input" name="optradio">Técnico
    </label>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="id" placeholder="ID" name="id" required>
    <div class="valid-feedback">Válido.</div>
    <div class="invalid-feedback">Estou muito triste você não me viu??? Por favor preencha este campo.</div>
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