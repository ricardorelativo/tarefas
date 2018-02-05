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
        
        /* exibe titulo e lista dos botões */
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
            $view->pagina('home'); 
            break;
                
        }
           
        
    }
	
    /* função que grava uma nova tarefa */
    public function adicionarNovaTarefa ($codigoEnc) {
		 
            $dadosGeral = base64_decode($codigoEnc);
            
            /* realiza separação das variaveis */
            $dadosArray = explode('#@', $dadosGeral);
            $pegadata = base64_decode($dadosArray[1]);
            $pegahorario = base64_decode($dadosArray[2]);
            $nome = base64_decode($dadosArray[3]);
        
    
        // verifica se o data foi escolhida
        if (empty($pegadata) || $pegadata == '') {
            echo '<div class="div_msg" ><h3>';
            echo "Você deve escoler uma data";
            echo '</h3></div>';
        /* exibe formulario para adicionar */
        $view = new View();
		$view->formulario('adicionar',''); 
        
        // verifica se a mensagem foi digitada
        } elseif (empty($pegahorario) || $pegahorario == '') {
            echo '<div class="div_msg" ><h3>';
            echo "Você deve escoler um horário";
            echo '</h3></div>';
        /* exibe formulario para adicionar */
        $view = new View();
		$view->formulario('adicionar',''); 
            
        // verifica se a mensagem foi digitada
        } elseif (empty($nome) || $nome == '') {
            echo '<div class="div_msg" ><h3>';
            echo "Você deve preencher a descrição";
            echo '</h3></div>';
            
        /* exibe formulario para adicionar */
        $view = new View();
		$view->formulario('adicionar',''); 
            
        // verifica se a mensagem nao ultrapassa o limite de caracteres
        } elseif (strlen($nome) > 200) {
            echo '<div class="div_msg" ><h3>';
            echo "A descrição deve ter no máximo 250 caracteres";
            echo '</h3></div>';
        
        /* exibe formulario para adicionar */
        $view = new View();
		$view->formulario('adicionar',''); 
            
        // Se não houver nenhum erro
        } else {
            
            /* realiza conversão da data antes exibir */
            $dataArray = explode('/', $pegadata);
            $inserirdata = $dataArray[2] . '-' . $dataArray[1]  . '-' . $dataArray[0]  ;
            
            echo '<div class="div_msg" ><h3>';
            echo "Tarefa adicionada com Sucesso
            <BR><BR>".  utf8_encode($nome) . " - No dia " . $pegadata . " às " . $pegahorario;
            echo '</h3></div>';
            
        /* conecta ao MySQL pelo Model e realiza a inclusão da tarefa  */
        $model = new Model();
        $model->adicionarDados($inserirdata,$pegahorario,$nome);
            
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
        
        $view = new View();
		$view->formulario('editar',$sql); 
       
      
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