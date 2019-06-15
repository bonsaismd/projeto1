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
carregarReceitas();
?>

<?php 
if ($cargo != 'Professor(a)') {
  header('location:'. BASEURL . 'login/redirect.php');
  echo $cargo;
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>home/prof/css.css">
<script type="text/javascript" src="js.js"></script>

<div class="board">
  <div class="board-content">
    <div class="p-3" id="boardCadeiras"> 
     <?php if(isset($discProf)){foreach ($discProf as $dP): ?>
     <div class="pedido-coluna text-left">
        <div class="pedido-conteudo">
          <div class="pedido-header">
            <h2 class="nome-disciplina"><?php echo nomeOferta($dP) ; ?></h2>
            <h3 class="nome-professor"><?php echo pesquisarProfessorNome($dP['oferta_ID']); ?></h3>
          </div>
          <div class="pedido-body">
           <?php for ($ind=0; $ind<mysqli_fetch_array(dadosOferta($dP))['QTDE_AULAS'];$ind ++){
            $aula=mysqli_fetch_array(pedidoOferta($dP['oferta_ID'],$ind));?>

            <div>
              <?php if(mysqli_num_rows ((pedidoOferta($dP['oferta_ID'],$ind)))>0){?>
                <a class="btn-aula" data-toggle="modal" data-target="#modalAula" data-id="<?php echo $aula['ID']?>" data-aula="<?php echo $aula['DIA_ENTREGA']; ?>">
              <h4 class="nome-aula"><?php echo $aula['TITULO']; ?></h4>
              <h5 class="data-aula detalhe-aula"><?php echo date_format(date_create($aula['DIA_ENTREGA']), 'd/m/Y'); ?></h5>
              <h5 class="custo-aula detalhe-aula text-right">R$<?php echo $aula['CUSTO'] ?></h5>
              <div style="clear:both;"></div>
            </a>

                <?php ;} else{?>
                  <button type="button" class="btn-aula btn-block" class="botaoPedido" data-toggle="modal" data-target="#modalAula"
                  data-aula='{
                  "id":"<?php echo mysqli_fetch_array(dadosOferta($dP))['ID'];?>",
                  "ind_Aula": "<?php echo $ind ;?>"
                }'
                >
                Aula <?php echo $ind +1;?>
              </button>

            </div>
          <?php }}?>
        </div></div>
      <?php endforeach;}?>
    </div></div></div>


    <div>

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDisc">
        Cadastrar cadeira
      </button>
    </div>





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

    <div class="modal fade" id="modalAula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
          <div class="modal-header">
            <input class="form-control" name="tituloAula" id="tituloAula" type=text placeholder="Título da Aula">
            
            <input type="text" class="form-control" id="dataPedidoA" placeholder="Data da Aula" onfocus="(this.type='date')">
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" >
            <form  class="form-inline" id= "forms">
              <div class="form-group">
                <input class="form-control" name="of_id" id="of_id" type=number disabled="true">
                <input class="form-control" name="indAula" id="indAula" type=number disabled="true">
                <select class="form-control" name="r_id" id="r_id" onchange="chng()"data-allow-clear="1">
                 <?php foreach ($receitasProf as $receita): ?>
                  <option class="form-control" value="<?php echo $receita['ID'];?>" data-srec='{
                    "nomeReceita":"<?php echo $receita['TITULO'];?>",
                    "insumosRS":<?php 
                    echo json_encode(insumosReceita($receita['ID'])); ;?>,
                    "custo":<?php echo $receita['CUSTO']?>,
                    "coment":"<?php echo $receita['OBSERVACAO'];?>"
                  }'
                  ><?php echo $receita['TITULO'];?> </option>
                <?php endforeach;?>   
              </select>
              <input class="form-control" type="number" name="quant" id="quantRP" value="1" onchange="chng()" onkeyup="chng()">
              <input class="form-control" type="number" name="preco" id="precoRecA" disabled="true">
            </div>

            <label><input type="button" class="btn btn-primary"name="ok" value="Ok" onclick="gridAula()"/></label>
          </form>

          <div id="corpoModal">

          </div>

          <div class="modal-footer">
            <h1>Custo total <div class="input-group ">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
              </div>
              <input class="form-control formatted-number-input" id="custoTA" type="number" placeholder="R$00,00"  disabled="true" style="width: 100px;">
            </h1>
            <button type="button" onclick="salvarAula()" data-dismiss="modal" class="btn btn-primary">Salvar aula</button>
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