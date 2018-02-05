<?php

class View {
  
    /* função para exibir tela de abertura */
    public function pagina($tipo) {
        
        if ($tipo=='listar'){
            
            /* verifica se existe as variáveis e se a ação é de excluir */
            if((isset($_GET['acao']))  && (isset($_GET['id'])) && ($_GET['acao']=='excluir')){

            $controller = new Controller();
            $controller->botoes($tipo); 
            $controller->excluir($_GET['id']); 

            /* verifica se existe as variáveis e se a ação é de editar */
            } elseif ((isset($_GET['acao'])) && (isset($_GET['id'])) && ($_GET['acao']=='editar')){

            $controller = new Controller();
            $controller->botoes($tipo); 
            $controller->editar($_GET['id']); 

            /* verifica se existe as variáveis e se a ação é salvar as alterações */
            } elseif ((isset($_GET['acao'])) && (isset($_GET['mudanca'])) && ($_GET['acao']=='editar')){

            $controller = new Controller();
            $controller->botoes($tipo); 
            $controller->salvar($_GET['mudanca']); 

            /* caso não tenha sido validado nenhum dos critérios acima */
            } else {

            $controller = new Controller();
            $controller->botoes($tipo); 
            $controller->listar(); 

            }
            
        } elseif ($tipo=='adicionar'){ 
            
            /* verifica existencia de ação */
            if((isset($_GET['acao'])) && ($_GET['acao']=='nova')){


            /* pega variavel codificada */
            $dadosEnc = $_GET['incluir'];

            /* exibe formulario para adicionar */
            $controller = new Controller();
            $controller->botoes($tipo); 
            $controller->adicionarNovaTarefa($dadosEnc); 


            } else {

            /* exibe formulario para adicionar */
            $controller = new Controller();
            $controller->botoes($tipo); 
                
            /* exibe formulario para adicionar */
            $view = new View();
            $view->formulario('adicionar',''); 
            }
        
        } else {
            
       /* consulta as operações do Controller */
       $controller = new Controller();
       $controller->botoes($tipo); 
        
        echo '<div class="div_conteudo">
                <div class="div_msg" >
				<h3>Sistema de Gerenciamento de Tarefas</h3>
				<p>Desenvolvido por <b>Ricardo Felisbino</b></p>
                </div>
			</div>';
            
        } 
        
    }
    
    
    
    public function salvar() {
		
		/* verifica existencia de ação */
        if((isset($_GET['acao'])) && ($_GET['acao']=='salvar')){
        
    
        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->salvarTarefa(); 
            
        }
        
	}
    
    public function formulario($tipo,$operacao) {
		

        if ($tipo=='adicionar'){
         
?>

        <div class="div_conteudo"><div class="div_msg" >
            
          <h3>Cadastro Nova Tarefa</h3>
            
                        <strong>Dia:</strong>
                        <input name="novadata" type="text" id="novadata" OnKeyPress="formatar(this, '##/##/####')" onBlur="return doDate(this.id,this.value, 4);" maxlength="10"  />
                 
                        <strong>Horário:</strong>
                        <input name="novohorario" type="text" id="novohorario" OnKeyPress="formatar(this, '##:##')"  onBlur="return doHorario(this.id,this.value);"  maxlength="5"   />
                 
                        <br /><br />
                 
                        <strong>Descrição:</strong> 
                        <input name="novonome" type="text" id="novonome"  onBlur="return doNome(this.id,this.value);"  maxlength="200"   size="50" />
                        
                        <br /><br />
                    
                        <input type="submit" class="bt_CancelarTarefa" value="Cancelar" />
                        
                        <input type="submit" class="bt_NovaTarefa" value="Adicionar" />

        </div></div>
                            
<?php            
        } elseif ($tipo=='editar'){ 
            
         $exibe = mysqli_fetch_assoc($operacao);
    
                    
            /* realiza conversão da data antes exibir */
            $dataArray = explode('-', $exibe['data']);
            $data = $dataArray[2] . '/' . $dataArray[1]  . '/' . $dataArray[0]  ;
            
            /* realiza conversão da data antes exibir */
            $horarioArray = explode(':', $exibe['horario']);
            $horario = $horarioArray[0]  . ':' . $horarioArray[1] ;
        
        
  ?>
       <div class="div_conteudo"><div class="div_msg" >
           
          <h3>Tarefa selecionada: <b>#<?= $exibe['id'] ?></b></h3>
       
                <input type="hidden" name="editarid"  id="editarid" value="<?= $exibe['id'] ?>">
                        
                <strong>Dia:</strong>
                <input name="editardata" type="text" id="editardata" OnKeyPress="formatar(this, '##/##/####')" onBlur="return doDate(this.id,this.value, 4);" maxlength="10" value="<?= $data ?>" />
           
                <strong>Horário:</strong>
                <input name="editarhorario" type="text" id="editarhorario" OnKeyPress="formatar(this, '##:##')"  onBlur="return doHorario(this.id,this.value);"  maxlength="5"  value="<?= $horario ?>"   />
           
                <br /><br />
           
                <strong>Descrição:</strong> 
                <input name="editarnome" type="text" id="editarnome" size="50"  onBlur="return doNome(this.id,this.value);"  maxlength="200"   value="<?= utf8_encode($exibe['nome']) ?>" />
                        
                <br /><br />
                        
                <input type="submit" class="bt_CancelarTarefa" value="Cancelar" />
                    
                <input type="submit" class="bt_SalvaTarefa" value="Alterar" />

           </div></div>

<?php
        
        }
        
	}
}

?>