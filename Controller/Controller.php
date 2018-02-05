<?php

class Controller {
    
    /* função para criar os botões de navegação */
    public function botoes($tipo) {
        
        /* personalizando o msg sistema personalização das cores dos botões*/
        switch($tipo)   {
    
            case "listar":
                    $msg = ' - Listar';
                    $home = '';
                    $tarefa = ' ativo';
                    $nova = '';
            break;
            case "adicionar":
                    $msg = ' - Nova';
                    $home = '';
                    $tarefa = '';
                    $nova = ' ativo';
            break;
            default: 

                    $msg = ' - Home';
                    $home = ' ativo';
                    $tarefa = '';
                    $nova = '';

            break;
        }
        
        /* exibe lista dos botões */
        echo '
         <div class="div_titulo" >
            <h3>Lista de Tarefas'. $msg .'</h3>
        </div>
         <div class="div_navegacao" >
                <div id="bt_Geral" class="botoes' . $home . '" >Página Inicial</div>
                <div id="bt_Listar" class="botoes' . $tarefa . '" >Listar das Tarefas</div>
                <div id="bt_Adicionar" class="botoes' . $nova . '" >Adicionar Tarefa</div>
        </div>
        ';
        
    }
	
	public function navegacao($operacao) {
        
        switch($operacao)   {
    
            case "Listar":

            $view = new View();
            $view->pagina('listar'); 

            break;

            case "Adicionar":

            $view = new View();
            $view->pagina('adicionar'); 

            break;  

            default: 

            $view = new View();
            $view->home('geral'); 

            break;
                
        }
           
        
    }
	
    public function adicionar() {
      		
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
            
            
    }	
	
    /* função que grava uma nova tarefa */
    public function adicionarTarefa ($codigoEnc) {
		 
            $dadosGeral = base64_decode($codigoEnc);
            
            /* realiza separação das variaveis */
            $dadosArray = explode('#@', $dadosGeral);

            $dataNormal = base64_decode($dadosArray[1]);
        
            /* verifica se campo data não está em branco e realiza conversão da data antes de inserir na base de dados */
            if($dataNormal != ''){
            $dataArray = explode('/', $dataNormal);
            $data = $dataArray[2] . '-' . $dataArray[1]  . '-' . $dataArray[0]  ;
            } else {
            $data = '';
            }
        
            $horario = base64_decode($dadosArray[2]);
            $nome = base64_decode($dadosArray[3]);
        
    
        // verifica se o data foi escolhida
        if (empty($data) || $data == '') {
            echo '<div class="div_msg" ><h3>';
            echo "Você deve escoler uma data";
            echo '</h3></div>';
        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->adicionar(); 
        
        // verifica se a mensagem foi digitada
        } elseif (empty($horario) || $horario == '') {
            echo '<div class="div_msg" ><h3>';
            echo "Você deve escoler um horário";
            echo '</h3></div>';
        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->adicionar(); 
            
        // verifica se a mensagem foi digitada
        } elseif (empty($nome) || $nome == '') {
            echo '<div class="div_msg" ><h3>';
            echo "Você deve preencher a descrição";
            echo '</h3></div>';
            
        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->adicionar(); 
            
        // verifica se a mensagem nao ultrapassa o limite de caracteres
        } elseif (strlen($nome) > 200) {
            echo '<div class="div_msg" ><h3>';
            echo "A descrição deve ter no máximo 250 caracteres";
            echo '</h3></div>';
        
        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->adicionar(); 
            
        // Se não houver nenhum erro
        } else {
            
            /* realiza conversão da data antes exibir */
            $dataArray = explode('-', $data);
            $exibirData = $dataArray[2] . '/' . $dataArray[1]  . '/' . $dataArray[0]  ;
            
            
            /* realiza conversão da data antes exibir */
            $horarioArray = explode(':', $horario);
            $exibirHorario = $horarioArray[0]  . ':' . $horarioArray[1] ;
            
            echo '<div class="div_msg" ><h3>';
            echo "Tarefa adicionada com Sucesso
            <BR><BR>".  utf8_encode($nome) . " - No dia " . $exibirData . " às " . $exibirHorario;
            echo '</h3></div>';
            
        /* conecta ao MySQL pelo Model e realiza a inclusão da tarefa  */
        $model = new Model();
        $model->adicionarDados($data,$horario,$nome);
            
        }
     
        
    }	
	
    public function listar() {
		
        /* conecta ao MySQL pelo Model e realiza a consulta das tarefas */
        $model = new Model();
        $sql = $model->listarTarefas();
        
        echo '<div class="div_conteudo">';
        
        /* verifica se há regisatros no sistyema */
        if(mysqli_num_rows($sql)>0){
            
            echo '<div class="div-table">
                <div class="div-table-row div-table-head">
                    <div class="div-table-cell">#</div>
                    <div class="div-table-cell">Dia</div>
                    <div class="div-table-cell">Horário</div>
                    <div class="div-table-cell">Descrição</div>
                    <div class="div-table-cell">Editar</div>
                    <div class="div-table-cell">Excluir</div>
                </div>';
            
            /* inicio do loop */    
            while($linhas = mysqli_fetch_assoc($sql)):
            
            
            /* realiza conversão da data antes exibir */
            $dataArray = explode('-', $linhas['data']);
            $data = $dataArray[2] . '/' . $dataArray[1]  . '/' . $dataArray[0]  ;
            
            /* realiza conversão da data antes exibir */
            $horarioArray = explode(':', $linhas['horario']);
            $horario = $horarioArray[0]  . ':' . $horarioArray[1] ;
            
            ?>
                               
                                <div class="div-table-row">
                                <div class="div-table-cell"><?= $linhas['id'] ?></div>
                                <div class="div-table-cell"><?= $data ?></div>
                                <div class="div-table-cell"><?= $horario ?></div>
                                <div class="div-table-cell"><?= utf8_encode($linhas['nome']) ?></div>
                                <div class="div-table-cell">
                                <input TYPE="BUTTON" NAME="submit" class="bt_ListarEditar" value="Editar" onclick="alterar('<?php echo $linhas["id"]; ?>')" >
                                </div>
                                <div class="div-table-cell">
                                <input TYPE="BUTTON" NAME="submit" class="bt_ListarExcluir" value="Excluir" onclick="apagar('<?= $linhas['id'] ?>')" >
                                </div>

                                </div>

            <?php
            /* termino do loop */       
            endwhile;   
                        
        } else {
            /* caso não tenha registro no banco de dados */
                    echo '<div class="div_msg" ><h3>Não há registrados no sistema.</h3></div>';
        }
        
        /* finaliza div conteudo */
        echo '</div>';
	}
	
    public function editar($id) {
       
        $model = new Model();
        $sql = $model->selecionarDados($id);
        
        $exibe = mysqli_fetch_assoc($sql);
    
                    
            /* realiza conversão da data antes exibir */
            $dataArray = explode('-', $exibe['data']);
            $data = $dataArray[2] . '/' . $dataArray[1]  . '/' . $dataArray[0]  ;
            
            /* realiza conversão da data antes exibir */
            $horarioArray = explode(':', $exibe['horario']);
            $horario = $horarioArray[0]  . ':' . $horarioArray[1] ;
        
  ?>
       <div class="div_conteudo"><div class="div_msg" >
           
          <h3>Tarefa selecionada: <b>#<?= $id ?></b></h3>
       
                <input type="hidden" name="editarid"  id="editarid" value="<?= $id ?>">
                        
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
    
	
    public function salvar($mudanca) {
        
        
            $dadosGeral = base64_decode($mudanca);
            
            /* realiza separação das variaveis */
            $dadosArray = explode('#@', $dadosGeral);

            $id = base64_decode($dadosArray[1]);
            $pegadata = base64_decode($dadosArray[2]);
            $pegahorario = base64_decode($dadosArray[3]);
            $nome = base64_decode($dadosArray[4]);
            
        
        // verifica se o data foi escolhida
        if (empty($pegadata) || $pegadata == '') {
            echo '<div class="div_msg" ><h3>';
            echo "Você deve escoler uma data";
            echo '</h3></div>';
            
        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->editar($id); 
        
        // verifica se a mensagem foi digitada
        } elseif (empty($pegahorario) || $pegahorario == '') {
            echo '<div class="div_msg" ><h3>';
            echo "Você deve escoler um horário";
            echo '</h3></div>';
            
        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->editar($id); 
            
        // verifica se a mensagem foi digitada
        } elseif (empty($nome) || $nome == '') {
            echo '<div class="div_msg" ><h3>';
            echo "Você deve preencher a descrição";
            echo '</h3></div>';
            
        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->editar($id); 
            
        // verifica se a mensagem nao ultrapassa o limite de caracteres
        } elseif (strlen($nome) > 200) {
            echo '<div class="div_msg" ><h3>';
            echo "A descrição deve ter no máximo 200 caracteres";
            echo '</h3></div>';
        
        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->editar($id); 
            
        // Se não houver nenhum erro
        } else {
            
            /* realiza conversão da data antes inserir */
            $dataArray = explode('/', $pegadata);
            $data = $dataArray[2] . '-' . $dataArray[1]  . '-' . $dataArray[0]  ;
            
            echo '<div class="div_msg" ><h3>Tarefa #' . $id . ' alterada com Sucesso.
            <BR><BR>'.  utf8_encode($nome) . ' - No dia ' . $pegadata . ' às ' . $pegahorario . '</h3></div>';
        
            /* conecta ao MySQL pelo Model e realiza a inclusão da tarefa  */
            $model = new Model();
            $model->alterarDados($id, $data,$pegahorario,$nome);
        
            
        }
        
    }
    
    public function excluir($id) {
    		
        /* conecta ao MySQL pelo Model e realiza a exclusão da tarefa  */
        $model = new Model();
        $model->excluirDados($id);
            
        echo '<div class="div_msg" >
                <h3>Tarefa de código #' . $id . ' foi excluida</h3>
            </div>';
        
        
    }
    
}

?>