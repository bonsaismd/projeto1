 <?php
 include("../../login/check.php");
  require_once('functions.php');
  carregarInsumos(); 
carregarDisciplinas();
carregarProfessores();
carregarDiscProf();
carregarReceitas();
saldoProfessor();
$dados=0;
  $dados+=(($_GET['id']));
$cor=intval(mysqli_fetch_array(dadosOfertaP($dados))['COR']);
 ?>
        
          <form id="formDisc" action="alterDisc.php" method="post">
            
            <label>ESCOLHA A DISCIPLINA
            <select class="form-control" required="" name="d_nome_e" id="d_nome_e" data-allow-clear="1">
              <option disabled >Disciplina...</option>
              <?php foreach ($disciplinas as $disciplina): ?>
                <option class="form-control" id= "" value="<?php echo $disciplina['ID'];?>" <?php if(mysqli_fetch_array(dadosOfertaP($dados))['disciplina_ID']== $disciplina['ID']){ ?>selected <?php } ?> ><?php echo $disciplina['NOME'];?></option>
              <?php endforeach;?>   
            </select></label>
            <label>ALGUM PROFESSOR LECIONA ESSA DISCIPLINA JUNTO A VOCÊ?
              <select class="form-control" name="outro_prof_e" id="outro_prof_e" data-allow-clear="1">
                <option disabled >Qual?</option>
                <?php foreach ($professores as $professor): ?>

                  <option class="form-control" id= "" value="<?php echo $professor['autenticacao_ID'];?>"


                    <?php if($professor['autenticacao_ID']==mysqli_fetch_array(pesquisarOutroProf($dados))[0])
                    { ?>selected="true"<?php
                    };?> ><?php echo $professor['NOME'];?></option>
                <?php endforeach;?>
                <option value= "0">Nenhum</option>   
              </select></label>
              <br>
              <input id="id_oferta_e" name="id_oferta_e"  required="" min=0 class="form-control" type="number" style=  "width:70px ; display: none;" value="<?php echo ($_GET['id']);?>" readonly>
              <label>QUANTOS ALUNOS ESTÃO MATRICULADOS?<input id="qtdeAlunos_e" name="qtdeAlunos_e" required="" min=0 class="form-control" type="number" style=  "width:70px ;" value="<?php echo intval(mysqli_fetch_array(dadosOfertaP($dados))['QTDE_ALUNOS']);?>"></label>
              <br>
              <label>QUANTAS AULAS PRÁTICAS SERÃO OFERTADAS?<input id="qtdePraticas_e" name="qtdePraticas_e" min="0" required="" class="form-control" type="number" style=  "width:70px ;" value="<?php echo intval(mysqli_fetch_array(dadosOfertaP($dados))['QTDE_AULAS']);?>"></label>
              <br>
               <div class="spaceAround">
              <label class="text-left"> REPRESENTE SUA DISCIPLINA COM UMA COR:

                <div class="etiquetas">
                  <input type="radio" name="etiquetas_e" id="roxo" value="1"<?php if($cor==1){ ?>checked<?php }else{} ?> required="">
                  <input type="radio" name="etiquetas_e" id="amarelo" value="2"<?php if($cor==2) { ?>checked<?php }else{} ?>>
                  <input type="radio" name="etiquetas_e" id="verde" value="3"<?php if($cor==3){ ?>checked<?php }else{} ?>>
                  <input type="radio" name="etiquetas_e" id="azul" value="4"<?php if($cor==4){ ?>checked<?php }else{} ?>>
                </div></label>
</div>
                <button type="submit" class="btn btn-secondary text-center" >Salvar alterações</button>
              </form>


              
      
