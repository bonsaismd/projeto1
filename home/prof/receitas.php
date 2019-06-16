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
carregarReceitas();
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
<div class="flexReceitas">
<?php foreach ($receitasProf as $receita): ?>
<?php if($receita['PUBLICA']==1){ ?>
  <button type="button" class=" btn-receita p-3"  data-toggle="modal" data-target="#modalReceitaExist" data-receita=
  '{
  "titulo":"<?php echo ($receita)['TITULO'];?>",
  "idR":"<?php echo $receita['ID'];?>",
  "insumosR":<?php echo json_encode(((insumosReceita($receita['ID']))));;?>
}'><?php echo $receita['TITULO'];?>
</button>
<?php }endforeach;?>

<button type="button" class="btn btn-primary p-3" class="botaoPedido" data-toggle="modal" data-target="#modalReceita">FAZER RECEITA
</button>
</div>
<div class="modal fade" id="modalReceitaExist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <input class="form-control" name="tituloRecE" id="tituloRecE" type="text" disabled="true" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >

<!---
        <form  class="form-inline" id= "forms">
          <div class="form-group">
            <input class="form-control" name="of_id" id="of_id" type=number disabled="true">
            <input class="form-control" name="indAula" id="indAula" type=number disabled="true">
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
        --->
        <div class="table-responsive">
          <div class="tbl_receita_data" id="tbl_receita_data"></div>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Insumo</th>
                <th>Unidade de Medida</th>
                <th>Valor Unitário</th>
                <th>Quantidade</th>
                <th>Custo</th>
              </tr>
            </thead>

            <tbody class="bodyReceita">
            </tbody>
          </table>


        </div> 
      </div>

      <div class="modal-footer">
        <h1>Custo total <div class="input-group ">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
          </div>
          <input class="form-control" class=" formatted-number-input"  id="custoTR" type="number" placeholder="R$00,00"  disabled="true" style="width: 100px;">
        </h1>
        <button type="button" onclick="" data-dismiss="modal" class="btn btn-primary">Salvar lista</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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


<div class="modal fade" id="modalReceita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <input class="form-control" name="tituloRec" id="tituloRec" type=text placeholder="Título da Receita">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >


        <form  class="form-inline" id= "forms">
          <div class="form-group">
            <input class="form-control" name="of_id" id="of_id" type=number disabled="true">
            <input class="form-control" name="indAula" id="indAula" type=number disabled="true">
            <select class="form-control" name="e_id" id="e_id" onchange="och(this)"data-allow-clear="1" required="true">
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

          <label><input id="qtde"  required="true"class="form-control" type="number" onchange="och()" onkeyup="och()" value="1" style=  "width:70px ;"></label>

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
          <button type="button" onclick="mandar()" data-dismiss="modal" class="btn btn-primary">Salvar lista</button>
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