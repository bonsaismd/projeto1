<?php 
require_once('../config.php');
require_once(DBAPI);

session_start();

if ((isset($_SESSION['inputID']) != '')){
	header('Location: home.php');
	if($_SESSION['Perm'] == 1){
    header('location:../home/prof');
    
  }elseif ($_SESSION['Perm'] == 2) {
    header('location:../home/coord');

  }elseif ($_SESSION['Perm'] == 3) {
    header('location:../home/tec');
  }
}

include(HEADER_TEMPLATE);
?>
<section id="loginSection">

  <div id="logo" >
    <img src="<?php echo BASEURL; ?>img/logo-original.svg" class="animated bounceIn">
  </div>

  <div id="login">
    <div class="container animated fadeIn delay-1s">
      <form method="POST" action="connecting.php" id="formLogin" name="formLogin" class="needs-validation" novalidate>

        <div class="form-group">
          <label for="inputID">ID:</label>
          <input type="number" class="form-control" id="inputID" name="inputID" aria-describedby="emailHelp" placeholder="Digite seu ID" required>
          <div class="invalid-feedback">Por favor informe seu ID.</div>
        </div>

        <div class="form-group">
          <span><i class="fa"></i></span><label for="inputSenha">Senha:</label>
          <input type="password" class="form-control" id="inputSenha" name="inputSenha" data-toggle="password" placeholder="Digite sua Senha" required>
          <div class="invalid-feedback">Por favor informe sua senha.</div>
        </div>

        <div class="form-group text-center mb-0">
          <button type="submit" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Entrar</button>
        </div>

    </form>
  </div>
</div>

</section>

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

  $('#inputSenha').password('toggle');
</script>



<?php include(FOOTER_TEMPLATE); ?>