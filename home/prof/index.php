<?php 
include("../../login/check.php");
require_once('functions.php');

$id_usuario = $_SESSION['inputID'];
$nome_usuario = $_SESSION['nome'];

include(HEADER_TEMPLATE);
include(HEADER_MENU);

carregarInsumos(); 
carregarDisciplinas();
carregarProfessores();
carregarDiscProf();

?>

<?php 
if ($cargo != 'Professor(a)') {
  header('location:'. BASEURL . 'login/redirect.php');
  echo $cargo;
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>home/prof/css.css">
<div id="corpo" class="container">
   <?php if(isset($discProf)){foreach ($discProf as $dP): ?>
   <div class="disc" >
   <p><?php echo nomeOferta($dP) ; ?></p>
   <?php for ($ind=0; $ind<mysqli_fetch_array(dadosOferta($dP))['QTDE_PRATICAS'];$ind ++){?>
    <div>
<?php if(mysqli_num_rows ((pedidoOferta(mysqli_fetch_array(dadosOferta($dP))['ID'],$ind)))>0){?>
<p>Aqui já tem pedido</p>
<?php ;} else{?>
<button type="button" class="btn btn-primary btn-block" class="botaoPedido" data-toggle="modal" data-target="#modalExemplo">
  Aula <?php echo $ind +1;?>
</button>
      
    </div>
  <?php }}?>
   </div>
  <?php endforeach;}?>
</div>
<div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDisc">
  Cadastrar cadeira
</button>
</div>





<script type="text/javascript" src="js.js"></script>
<div class="modal fade" id="modalDisc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar nova disciplina prática</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body" >
        <form action="action.php" method="post">
            <select class="form-control" required="" name="d_nome" id="d_nome" data-allow-clear="1">
              <option disabled selected>Escolha a disciplina</option>
             <?php foreach ($disciplinas as $disciplina): ?>
              <option class="form-control" id= "" value="<?php echo $disciplina['ID'];?>" ><?php echo $disciplina['NOME'];?></option>
            <?php endforeach;?>   
          </select>
          <label>Algum professor dá essa disciplina também?
          <select class="form-control" name="outro_prof" id="outro_prof" data-allow-clear="1">
              <option disabled selected>Qual?</option>
             <?php foreach ($professores as $professor): ?>
              <option class="form-control" id= "" value="<?php echo $professor['autenticacao_ID'];?>" ><?php echo $professor['NOME'];?></option>
            <?php endforeach;?>   
          </select></label>
          <br>
          <label>Quantidade de alunos<input id="qtdeAlunos" name="qtdeAlunos" required="" class="form-control" type="number" style=  "width:70px ;"></label>
          <br>
          <label>Quantidade de aulas práticas<input id="qtdePraticas" name="qtdePraticas" required="" class="form-control" type="number" style=  "width:70px ;"></label>
          <br>

          <div class="etiquetas">
          <input type="radio" name="etiquetas" id="azul" value="1" required="">
          <input type="radio" name="etiquetas" id="amarelo" value="2">
          <input type="radio" name="etiquetas" id="magenta" value="3">
          </div>
  <input type="submit" value="Criar" id="bot">

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >




        <form  class="form-inline" id= "forms">
          <div class="form-group">
            <select class="form-control" name="of_id" id="of_id">
              
            </select>
            <select class="form-control" name="e_id" id="e_id" onchange="och(this)"data-allow-clear="1">
              <option disabled selected>ID</option>
             <?php foreach ($insumos as $insumo): ?>
              <option class="form-control" id= "<?php echo $insumo['NOME'];?>" value="<?php echo $insumo['ID'];?>" ><?php echo $insumo['ID'];?> </option>
            <?php endforeach;?>   
          </select>
        </div>
        <div class="form-group">
          <select class="form-control" id="e_nome" placeholder="Choose one thing" onchange="ochNome(this)" data-allow-clear="1">
              <option disabled selected> Escolha um insumo...</option>
            <?php foreach ($insumos as $insumo): ?>
              <option class="form-control" id= "e_n_opt" value="<?php echo $insumo['NOME'];?>" ><?php echo $insumo['NOME'];?> </option>
            <?php endforeach;?>      
          </select>
        </div>

        <div class="input-group ">
          <input class="form-control" class="formatted-number-input" id="precoUnit" type="number" placeholder="R$00,00"  disabled="true" style="width: 100px;">
        </div> 

        <label><input id="qtde" class="form-control" type="number" onchange="och()" onkeyup="och()" value="1" style=  "width:70px ;"></label>

        <div class="input-group ">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
          </div>
          <input class="form-control" id="custo"  class="formatted-number-input"  step="0.01" type="number" placeholder="R$00,00"  disabled="true" style="width: 100px;">
        </div>

        <div class="input-group ">
          <input class="form-control" id="unidMed" type="text" disabled="true" value=""style="width: 100px;"></div>
          <label><input type="button" class="btn btn-primary"name="ok" value="Ok" onclick="grid()"/></label>
        </form>

        <div class="table-responsive">
          <div class="tbl_user_data"></div>

        </div> 
      </div>

      <div class="modal-footer">
        <h1>Custo total <div class="input-group ">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
          </div>
          <input class="form-control" id="custoT" type="number" placeholder="R$00,00"  disabled="true" style="width: 100px;">
        </h1>
        <button type="button" onclick="mandar()" data-dismiss="modal" class="btn btn-primary">Salvar mudanças</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
</div>
<div class="panel panel-default">
  <div class="panel-heading"><b> Demo </b> </div>
  <div class="panel-body">


    <div class="panel panel-default">
      <div class="panel-heading"><b>HTML Table Edits/Upates</b> </div>

      <div class="panel-body">

        <p>All the changes will be displayed below</p>
        <div class="post_msg"> </div>

      </div>
    </div>
    <?php 
    include(FOOTER_TEMPLATE);
    ?>