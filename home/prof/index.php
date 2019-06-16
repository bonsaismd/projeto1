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
saldoProfessor();
?>

<?php 
if ($cargo != 'Professor(a)') {
  header('location:'. BASEURL . 'login/redirect.php');
  echo $cargo;
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>home/prof/css.css">
<script type="text/javascript" src="js.js"></script>
<b><a class="menuT" href="index.php">Disciplinas (<?php $tot=0; foreach($discProf as $d): $tot++; endforeach; echo $tot; ?>) </a>/<a class="menuT" href="receitas.php">Receits (<?php $totR=0; foreach($receitasProf as $r):if($r['PUBLICA']==1){ $totR++;}; endforeach; echo $totR?>)</a>
</b>
<div>
  <div id="board-content" class="p-3">
    <div>

      <a  class="fantasma" data-toggle="modal" data-target="#modalDisc">
        <div class="item">
         <div class="pedido-coluna text-left">
          <div class="pedido-conteudo-fant">
            <div class="pedido-header">
              <h2 class="nome-disciplina-fant">Criar disciplina</h2>
              <h3 class="nome-professor"><?php echo $nome_usuario?></h3>
            </div>
            <div class="pedido-body">
             <?php for ($ind=0; $ind<6;$ind ++){?>

              <div>
                <div class="btn-aula-fant btn-block" class="botaoPedido" >
                  Aula <?php echo $ind +1;?>
                </div>
                
              </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </a>
</div>
<?php if(isset($discProf)){foreach ($discProf as $dP): ?>
  <div class="item">
   <div class="pedido-coluna text-left">
    <div class="pedido-conteudo">
      <div class="disc-header" >
        <div class="disc-desc">
        <h2 class="nome-disciplina"><?php echo nomeOferta($dP) ; ?></h2>
        <h3 class="nome-professor"><?php echo pesquisarProfessorNome($dP['oferta_ID']); ?></h3>
      </div>
        <a data-toggle="modal" data-target="#modalDiscEdit"><i class="conf fas fa-cog fa-2x"></i></a>
      </div>
      <div class="pedido-body">
       <?php for ($ind=0; $ind<mysqli_fetch_array(dadosOferta($dP))['QTDE_AULAS'];$ind ++){
        $aula=mysqli_fetch_array(pedidoOferta($dP['oferta_ID'],$ind));?>

        <div>
          <?php if(mysqli_num_rows ((pedidoOferta($dP['oferta_ID'],$ind)))>0){?>
            <a class="btn-aula" data-toggle="modal" data-target="#modalAulaExist" data-id="<?php echo $aula['ID']?>" data-aula="<?php echo $aula['DIA_ENTREGA']; ?>">
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
        <?php }?>
      </div>
    <?php }?>
  </div>
</div>
</div>
</div>
<?php endforeach;}?>



</div>

</div>



  <div class="modal fade" id="modalDiscEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog "  role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" ><b>EDITAR DISCIPLINA PRÁTICA</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
          <form id="formDisc" action="action.php" method="post">
            <select class="form-control" required="" name="d_nome" id="d_nome" data-allow-clear="1">
              <option disabled selected>Escolha a disciplina</option>
              <?php foreach ($disciplinas as $disciplina): ?>
                <option class="form-control" id= "" value="<?php echo $disciplina['ID'];?>" ><?php echo $disciplina['NOME'];?></option>
              <?php endforeach;?>   
            </select>
            <label>Algum professor leciona essa disciplina junto a você?
              <select class="form-control" name="outro_prof" id="outro_prof" data-allow-clear="1">
                <option disabled selected>Qual?</option>
                <?php foreach ($professores as $professor): ?>
                  <option class="form-control" id= "" value="<?php echo $professor['autenticacao_ID'];?>" ><?php echo $professor['NOME'];?></option>
                <?php endforeach;?>
                <option value= "0">Nenhum</option>   
              </select></label>
              <br>
              <label>Quantidade de alunos<input id="qtdeAlunos" name="qtdeAlunos" required="" min=0 class="form-control" type="number" style=  "width:70px ;"></label>
              <br>
              <label>Quantidade de aulas práticas<input id="qtdePraticas" name="qtdePraticas" min="0" required="" class="form-control" type="number" style=  "width:70px ;"></label>
              <br>
              <label> REPRESENTE SUA DISCIPLINA COM UMA COR
                <div class="etiquetas">
                  <input type="radio" name="etiquetas" id="roxo" value="1" required="">
                  <input type="radio" name="etiquetas" id="amarelo" value="2">
                  <input type="radio" name="etiquetas" id="verde" value="2">
                  <input type="radio" name="etiquetas" id="azul" value="3">
                </div></label>


              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" >Concluir</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


  <div class="modal fade" id="modalDisc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog "  role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" ><b>NOVA DISCIPLINA PRÁTICA</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
          <form id="formDisc" action="action.php" method="post">
            <select class="form-control" required="" name="d_nome" id="d_nome" data-allow-clear="1">
              <option disabled selected>Escolha a disciplina</option>
              <?php foreach ($disciplinas as $disciplina): ?>
                <option class="form-control" id= "" value="<?php echo $disciplina['ID'];?>" ><?php echo $disciplina['NOME'];?></option>
              <?php endforeach;?>   
            </select>
            <label>Algum professor leciona essa disciplina junto a você?
              <select class="form-control" name="outro_prof" id="outro_prof" data-allow-clear="1">
                <option disabled selected>Qual?</option>
                <?php foreach ($professores as $professor): ?>
                  <option class="form-control" id= "" value="<?php echo $professor['autenticacao_ID'];?>" ><?php echo $professor['NOME'];?></option>
                <?php endforeach;?>
                <option value= "0">Nenhum</option>   
              </select></label>
              <br>
              <label>Quantidade de alunos<input id="qtdeAlunos" name="qtdeAlunos" required="" min=0 class="form-control" type="number" style=  "width:70px ;"></label>
              <br>
              <label>Quantidade de aulas práticas<input id="qtdePraticas" name="qtdePraticas" min="0" required="" class="form-control" type="number" style=  "width:70px ;"></label>
              <br>
              <label> REPRESENTE SUA DISCIPLINA COM UMA COR
                <div class="etiquetas">
                  <input type="radio" name="etiquetas" id="roxo" value="1" required="">
                  <input type="radio" name="etiquetas" id="amarelo" value="2">
                  <input type="radio" name="etiquetas" id="verde" value="2">
                  <input type="radio" name="etiquetas" id="azul" value="3">
                </div></label>


              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" >Concluir</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="modalSaldo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog "  role="document">
        <div class="modal-content">



          <div class="modal-header  text-center align-self-center">

            <div class="modal-header-content ">


              <h5 class="modal-title nome-disciplina" >SEU SALDO</h5>
              <div id="dadoSaldo" d="<?php echo $saldoProfT?>">
                <h6 class="modal-subtitle nome-professor" id="saldoTotal">R$ <span id="saldo" ></span></h6>

              </div>
            </div>
            <button type="button" class="close " data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button></div>



            <div class="modal-body" >
              <table>
                <tbody>
              <?php foreach($saldoProf as $s):?>
                <tr>
                  <td><?php echo $s[1];?></td>

                  <td><?php echo $s[0];?></td>

                </tr>

              <?php endforeach;?>
            </tbody>
          </table>
            </div>

            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>
    </div>











    <div class="modal fade" id="modalAulaExist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
          <div class="modal-header">
            <input class="form-control" name="tituloAula" disabled="true" id="tituloAula" type=text placeholder="Título da Aula">

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
<?php 
include(FOOTER_TEMPLATE);
?>