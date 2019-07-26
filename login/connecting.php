<?php

require_once('../config.php');
require_once(DBAPI);

session_start();

/** Abrindo banco de dados **/
$db = open_database();

/** Coletando informações do formulario **/
$id = mysqli_real_escape_string($db, $_POST['inputID']);
$senha = mysqli_real_escape_string($db, $_POST['inputSenha']);

/** Criando variaveis para verificar existencia no BD **/
$query_select = "SELECT * FROM autenticacao WHERE ID = '$id'";
$select = mysqli_query($db, $query_select);
$array = mysqli_fetch_array($select);
$id_db = $array['ID'];
$senha_hash = $array['SENHA'];
$permissao = $array['PERMISSAO'];

/** Verifica se ja existe cadastro com o ID digitado**/
if ($id_db == $id) {

  if (password_verify($senha, $senha_hash)) {
    $_SESSION['inputID'] = $id;
    $_SESSION['inputSenha'] = $senha;
    $_SESSION['Perm'] = $permissao;

    if($permissao == 1){
      $query_select_user = "SELECT * FROM professor WHERE autenticacao_ID = '$id'";
      $select_user = mysqli_query($db, $query_select_user);
      $array_user = mysqli_fetch_array($select_user);
      $_SESSION['nome'] = $array_user['NOME'];
      $_SESSION['cargo'] = 'Professor(a)';
      $redirecionar = '../home/prof';
    
    }elseif ($permissao == 2) {
      $query_select_user = "SELECT * FROM professor WHERE autenticacao_ID = '$id'";
      $select_user = mysqli_query($db, $query_select_user);
      $array_user = mysqli_fetch_array($select_user);
      $_SESSION['nome'] = $array_user['NOME'];
      $_SESSION['cargo'] = 'Coordenador(a)';
      $redirecionar = '../home/coord';

    }elseif ($permissao == 3) {
      $query_select_user = "SELECT * FROM tecnico WHERE autenticacao_ID = '$id'";
      $select_user = mysqli_query($db, $query_select_user);
      $array_user = mysqli_fetch_array($select_user);
      $_SESSION['nome'] = $array_user['NOME'];
      $_SESSION['cargo'] = 'Técnico(a)';
      $redirecionar  = '../home/tec';
    }
  }else {
    echo"<script language='javascript' type='text/javascript'>
    alert('Usuário ou senha incorreto!');window.location.href='../login';
    </script>";


   die();
  }


}else{
  echo"<script language='javascript' type='text/javascript'>
  alert('Usuário ou senha incorreto!');window.location.href='../login';
  </script>";

  die();
}

include(HEADER_TEMPLATE);
?>

<section id="loadingSection">
  

</section>

<?php include(FOOTER_TEMPLATE);?>
<?php
  header("Refresh:1 ; url=".$redirecionar);
?>