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

<div class="row p-4">
  <div class="col-2 p-0">
    <a class="btn btn-primary btns-header" href="index.php">Disciplinas (<?php $tot=0; foreach($discProf as $d): $tot++; endforeach; echo $tot; ?>) </a>
  </div>
  <div class="col-2 p-0">
    <a class="btn btn-primary btns-header" href="receitas.php">Fichas técnicas (<?php $totR=0; foreach($receitasProf as $r):if($r['PUBLICA']==1){ $totR++;}; endforeach; echo $totR?>)</a>
  </div>
  <div class="col-8"></div>
</div>

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
        <a data-toggle="modal" data-target="#modalDiscEdit" data-disc='<?php echo $dP['oferta_ID'];?>'
          ><i class="conf fas fa-cog fa-2x"></i></a>
        </div>
        <div class="pedido-body">
         <?php for ($ind=0; $ind<mysqli_fetch_array(dadosOferta($dP))['QTDE_AULAS'];$ind ++){
          $aula=mysqli_fetch_array(pedidoOferta($dP['oferta_ID'],$ind));?>

          <div>
            <?php if(mysqli_num_rows ((pedidoOferta($dP['oferta_ID'],$ind)))>0){?>
              <a class="btn-aula btn-block" data-toggle="modal" data-target="#modalAulaExist" idAula=<?php echo $aula['ID']?> >

                <h4 class="nome-aula text-center btn-block"><?php echo $aula['TITULO']; ?></h4>
                <div class=" detalhe-aD text-center btn-block">R$<?php echo $aula['CUSTO']?><span id="bolinha"> • </span><?php echo date_format(date_create($aula['DIA_ENTREGA']), 'd/m'); ?></div>
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
        <div class="modal-header-content text-center align-self-center w-100">
          <h5 class="modal-title font-weight-bold">Editar Disciplina Prática</h5>
        </div>
        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" id="modalDiscEditCorpo">

      </div>

      <div class="modal-footer">
        <button type="submit" form="formDiscEdit" class="btn btn-primary text-center" >Salvar Alterações</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modalAulaExist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" ><b>VISUALIZAR AULA PRÁTICA</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" href="index.php">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalAulaExistCorpo">

      </div>

      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalDisc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog "  role="document">
    <div class="modal-content">

      <div class="modal-header">
        <div class="modal-header-content text-center align-self-center w-100">
          <h5 class="modal-title font-weight-bold">Nova Disciplina Prática</h5>
        </div>
        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" >
        <form id="formDisc" action="action.php" method="post">

          <label for="d_nome" class="mb-1">Escolha a Disciplina:<span style="color: red">*</span> </label>
          <select class="form-control mb-3" required="" name="d_nome" id="d_nome" data-allow-clear="1">
            <option disabled selected>Disciplina...</option>
            <?php foreach ($disciplinas as $disciplina): ?>
              <option class="form-control" value="<?php echo $disciplina['ID']; ?>" ><?php echo $disciplina['NOME'];?></option>
            <?php endforeach;?>   
          </select>

          <label for="outro_prof" class="mb-1">Você leciona essa disciplina com outro professor?</label>
          <select class="form-control mb-3" name="outro_prof" id="outro_prof" data-allow-clear="1">
            <option disabled selected>Qual?</option>
            <?php foreach ($professores as $professor): ?>
              <option class="form-control" value="<?php echo $professor['autenticacao_ID'];?>" ><?php echo $professor['NOME'];?></option>
            <?php endforeach;?>
            <option value= "0">Nenhum</option>   
          </select>
          <label for="qtdeAlunos" class="mb-1">Quantos alunos estão matriculados?</label>
          <input id="qtdeAlunos" name="qtdeAlunos" required="" min=0 class="form-control mb-3" type="number" style="width:70px ;">

          <label for="qtdePraticas" class="mb-1">Quantas aulas práticas serão ofertadas?</label>
          <input id="qtdePraticas" name="qtdePraticas" min="0" required="" class="form-control mb-3" type="number" style="width:70px ;">

          <div class="spaceAround">
            <label for="etiquetas" class="mb-1">Escolha uma cor para representar sua disciplina:</label>
            <div class="etiquetas row">
              <div class="col-3">
                <input type="radio" name="etiquetas" id="roxo" value="1" required="">
              </div>
              <div class="col-3">
                <input type="radio" name="etiquetas" id="amarelo" value="2">
              </div>
              <div class="col-3">
                <input type="radio" name="etiquetas" id="verde" value="3">
              </div>
              <div class="col-3">
                <input type="radio" name="etiquetas" id="azul" value="4">
              </div>
            </div>
          </div>

        </form>

      </div>

      <div class="modal-footer">
        <button type="submit" form="formDisc" class="btn btn-primary text-center" >Concluir</button>
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

<div class="modal fade" id="modalMatriz" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <div class="modal-header-content text-center align-self-center">
          <h5 class="modal-title nome-disciplina">Matriz Licitada</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div id="MatrizAnual" class="m-2 mt-0 p-3">

          <div class="row mb-3 mt-0">
            <div class="col-sm-4 p-0">
              <div class="input-group" id="container-pesquisar">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
                <input class="form-control pesquisar" id="procurar" type="text" placeholder="Pesquisar insumo...">
              </div> 
            </div>
            <div class="col-sm-6"></div>
            <div class="col-sm-2 p-0 text-right">
            </div>
          </div>



          <!-- Cabeçalho da tabela -->
          <table class="table table-hover mb-0">
            <thead class="thead-light" id="tabelaHead">
              <tr class="row">
                <th class="col-1">ID</th>
                <th class="col-3">Nome</th>
                <th class="col-3">Unidade</th>
                <th class="col-3">Preço</th>
                <th class="col-2">Saldo</th>
              </tr>
            </thead>
          </table>

          <!-- Tabela de insumos -->
          <div class="table-responsive border">

            <table class="table table-hover" id="tabela" > 

              <tbody id="tabelaInsumos">

                <?php if ($insumos) : ?>

                  <?php foreach ($insumos as $insumo) : ?> 

                    <tr class="row text-center h-25">
                      <td class="col-1"><?php echo $insumo['ID'] ?></td>
                      <td class="col-3 text-left"><?php echo $insumo['NOME'] ?></td>
                      <td class="col-3"><?php echo $insumo['UNID_MEDIDA'] ?></td>
                      <td class="col-3">R$<?php echo $insumo['PRECO'] ?></td>
                      <td class="col-2"><?php echo $insumo['SALDO'] ?></td>
                    </tr>

                  <?php endforeach; ?>

                  <?php else : ?>
                    <tr>
                      <td colspan="6">Nenhum insumo encontrado.</td> 
                    </tr>
                  <?php endif; ?>

                </tbody>

              </table>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>

        <!-- Script que faz a filtragem da tabela -->
        <script>
          $(document).ready(function(){

            $("#procurar").on("keyup", function() { /* Sempre que uma tecla for levantada no campo de pesquisa */
              var value = $(this).val().toLowerCase();
              $('#tabelaInsumos > tr').filter(function() { /* Filtra na tabela com o valor do campo */
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
              });
            });

          });
        </script>
      </div>
    </div>
  </div>



  <div class="modal fade" id="modalAula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document">
      <div class="modal-content">
        <div class="modal-header">

          <div class="modal-header-content text-center align-self-center w-100">
            <h5 class="modal-title font-weight-bold">Cadastrar Nova Aula</h5>
          </div>        
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >

          <div class="row mb-4">
            <div class="col-6">
              <input class="form-control" name="tituloAula" id="tituloAula" type=text placeholder="Título da Aula">            
            </div>
            <div class="col-6">
              <input type="text" class="form-control" id="dataPedidoA" placeholder="Data da Aula" onfocus="(this.type='date')">            
            </div>
          </div>

          <form  class="" id= "forms">
            <div class="form-group">
              <input class="form-control" name="of_id" id="of_id" type=number disabled="true">
              <input class="form-control" name="indAula" id="indAula" type=number disabled="true">

              <div class="row">
                <div class="col-6">
                  <select class="form-control w-100" name="r_id" id="r_id" onchange="chng()"data-allow-clear="1">
                    <option disabled selected>Selecionar Ficha Técnica</option>
                    <?php foreach ($receitasProf as $receita):
                     if($receita['PUBLICA']==1){ ?>
                      <option class="form-control" value="<?php echo $receita['ID'];?>" data-srec='{
                        "nomeReceita":"<?php echo $receita['TITULO'];?>",
                        "insumosRS":<?php 
                        echo json_encode(insumosReceita($receita['ID'])); ;?>,
                        "custo":<?php echo $receita['CUSTO']?>,
                        "coment":"<?php echo $receita['OBSERVACAO'];?>"
                      }'
                      ><?php echo $receita['TITULO'];?> </option>
                    <?php } endforeach;?>   
                  </select>
                </div>

                <div class="col-2">
                  <input class="form-control" type="number" name="quant" id="quantRP" placeholder="Quantidade" onchange="chng()" onkeyup="chng()">
                </div>
                <div class="col-2">
                  <input class="form-control" type="number" name="preco" id="precoRecA" placeholder="Preço" disabled="true">
                </div>
                <div class="col-2 text-right">
                  <input type="button" class="btn btn-primary"name="ok" value="Ok" onclick="gridAula()"/>
                </div>
              </div>

            </div>

          </form>

          <div class="row mb-1">
            <div class="col-12">
              <div id="corpoModal">

              </div>
            </div>
          </div>

          <div class="modal-footer">

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Custo Total: (R<i class="fas fa-dollar-sign"></i>)</span> 
              </div>
              <input class="form-control formatted-number-input" id="custoTA" type="number" placeholder="R$00,00"  disabled="true" >
            </div>
            <button type="button" onclick="salvarAula()" data-dismiss="modal" class="btn btn-primary" style="margin-left: 38%;">Salvar aula</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

          </div>
        </div>
      </div>
    </div>

    <?php 
    include(FOOTER_TEMPLATE);
    ?>