<?php
require_once('functions.php');
carregarInsumos();
?>
        <form  class="form-inline" id= "forms">
          <div class="form-group">
            
            <select class="form-control" name="e_id_e" id="e_id_e" onchange="och_e(this)"data-allow-clear="1">
              <option disabled selected>ID</option>
             <?php foreach ($insumos as $insumo): ?>
              <option class="form-control" id= "<?php echo $insumo['NOME'];?>" value="<?php echo $insumo['ID'];?>" ><?php echo $insumo['ID'];?> </option>
            <?php endforeach;?>   
          </select>
        </div>
        <div class="form-group">
          <select class="form-control" id="e_nome_e" onchange="ochNome_e(this)" data-allow-clear="1">
              <option disabled selected> Escolha um insumo...</option>
            <?php foreach ($insumos as $insumo): ?>
              <option class="form-control" id= "e_n_opt_e" value="<?php echo $insumo['NOME'];?>" ><?php echo $insumo['NOME'];?> </option>
            <?php endforeach;?>      
          </select>
        </div>

        <div class="input-group ">
          <input class="form-control" class="formatted-number-input" id="precoUnit_e" type="number" placeholder="R$00,00"  disabled="true" style="width: 100px;">
        </div> 

        <label><input id="qtde_e" class="form-control" type="number" onchange="och_e()" onkeyup="och_e()" value="1" style=  "width:70px ;"></label>

        <div class="input-group ">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
          </div>
          <input class="form-control" id="custo_e"  class="formatted-number-input"  step="0.01" type="number" placeholder="R$00,00"  disabled="true" style="width: 100px;">
        </div>

        <div class="input-group ">
          <input class="form-control" id="unidMed_e" type="text" disabled="true" value=""style="width: 100px;"></div>
          <label><input type="button" class="btn btn-primary"name="ok" value="Ok" onclick="grid_e()"/></label>
        </form>