<?php

class Controller {
    
    /* função para criar os botões de navegação */
    public function botoes($tipo) {
        
        /* personalizando o msg sistema  
		personalização das cores dos botões*/
        switch($tipo)   {
    
            case "tarefa":
                    $msg = ' - Listar';
                    $cor1 = 'silver';
                    $cor2 = 'blue';
                    $cor3 = 'silver';
            break;
            case "nova":
                    $msg = ' - Nova';
                    $cor1 = 'silver';
                    $cor2 = 'silver';
                    $cor3 = 'blue';
            break;
            default: 

                    $msg = ' - Home';
                    $cor1 = 'blue';
                    $cor2 = 'silver';
                    $cor3 = 'silver';

            break;
        }
        
        /* exibe lista dos botões */
        echo '
         <div class="div-table" style="background-color: rgba(255, 255, 255, 0.4);">
            <div class="div-table-row" style="border:0;">
                <div class="div-table-cell" style="border:0;"><h3>Lista de Tarefas'. $msg .'</h3>
                </div>
            </div>
        </div>
                <div id="bt_Geral" style="background-color: ' . $cor1 . '; border-radius: 50%; padding: 15px; display: inline;" >Página Inicial</div>
                <div id="bt_Listar" style="background-color: ' . $cor2 . '; border-radius: 50%; padding: 15px; display: inline;" >Listar Tarefas</div>
                <div id="bt_Adicionar" style="background-color: ' . $cor3 . '; border-radius: 50%; padding: 15px; display: inline;" >Adicionar Tarefa</div>
        ';
        
    }
	
	public function navegacao($operacao) {
        
        switch($operacao)   {
    
            case "Listar":

            $view = new View();
            $view->opcao('tarefa'); 
            $view->listar(); 

            break;

            case "Adicionar":

            $view = new View();
            $view->opcao('nova'); 
            $view->adicionar(); 

            break;  

            default: 

            $view = new View();
            $view->opcao('geral'); 
            $view->home(); 

            break;
                
        }
           
        
    }
	
    public function adicionar() {
      
	  echo "
         <div class='div-table'>
            <div class='div-table-row'>
                <div class='div-table-cell' >
        
                    <label>Dia:</label>
                    <input type='date' name='data' value=''><BR>
                    <label>Horário:</label>
                    <input type='time' name='horario' value=''><BR>
                    <label>Descrição:</label>
                    <input type='text' name='nome' value=''><BR>

                    <button type='submit' class='bt_NovaTarefa'>Adicionar</button>
        
                </div>
            </div>
        </div>";
		
    }	
	
    /* função que grava uma nova tarefa */
    public function adicionarTarefa () {
		 
        echo '
         <div class="div-table">
            <div class="div-table-row">
                <div class="div-table-cell"><h3>Nada foi adicionado</h3>
                </div>
            </div>
        </div>';
     
    }	
	
    public function listar() {
		
        /* conecta ao MySQL pelo Model e realiza a consulta das tarefas */
        $model = new Model();
        $consulta = "SELECT * FROM tarefas"; 
        $sql = mysqli_query(($model->conectar()), $consulta);
        
        echo '<div class="div-table">
                <div class="div-table-row div-table-head">
                    <div class="div-table-cell">#</div>
                    <div class="div-table-cell">Dia</div>
                    <div class="div-table-cell">Horário</div>
                    <div class="div-table-cell">Descrição</div>
                    <div class="div-table-cell">Editar</div>
                    <div class="div-table-cell">Excluir</div>
                </div>';
        
        /* verifica se há regisatros no sistyema */
        if(mysqli_num_rows($sql)>0){
            
            /* inicio do loop */    
            while($linhas = mysqli_fetch_assoc($sql)):
            ?>
                                <div class="div-table-row">
                                <div class="div-table-cell"><?= $linhas['id'] ?></div>
                                <div class="div-table-cell"><?= $linhas['data'] ?></div>
                                <div class="div-table-cell"><?= $linhas['horario'] ?></div>
                                <div class="div-table-cell"><?= $linhas['nome'] ?></div>
                                <div class="div-table-cell">
                                <input TYPE="BUTTON" NAME="submit" class="bt_ListarEditar" value="Editar" onclick="alterar('<?php echo $linhas["id"] . "', '" . $linhas["data"] . "', '" . $linhas["horario"] . "', '" . $linhas["nome"]; ?>')" >
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
                    echo '
                <div class="div-table">
                    <div class="div-table-row">
                        <div class="div-table-cell">Não há registrados no sistema
                        </div>
                    </div>
                </div>';
        }

        
	}
	
    public function editar($id,$data,$horario,$nome) {
       
	
		echo '  
		<div class="div-table">
            <div class="div-table-row">
                <div class="div-table-cell"><h3>Tarefa selecionada: <b>#' . $id . '</b></h3></div>
            </div><div class="div-table-row">
                <div class="div-table-cell" >
                <label>Dia:</label>
                <input type="date" name="data" value="'. $data .'"></div>
            </div><div class="div-table-row">
                <div class="div-table-cell" >
                <label>Horário:</label>
                <input type="time" name="horario" value="'. $horario .'"></div>
            </div><div class="div-table-row">
                <div class="div-table-cell" >
                <label>Descrição:</label>
                <input type="text" name="nome" value="'. $nome .'"></div>
            </div><div class="div-table-row">
                <div class="div-table-cell" >
                <button type="submit" class="bt_SalvaTarefa">Salvar</button>
                </div>
            </div>
        </div>';
        
    }
	
    /* função que grava as alterações da tarefa */
    public function salvarTarefa () {
		 
        echo '
        
         <div class="div-table">
            <div class="div-table-row">
                <div class="div-table-cell"><h3>Nada foi salvo</h3>
                </div>
            </div>
        </div>';
     
    }	
    
    public function excluir($id) {
    		
        echo '
        <div class="div-table">
            <div class="div-table-row">
                <div class="div-table-cell">
                <h3>Tarefa (' . $id . ') será excluida em breve</h3>
                </div>
            </div>
        </div>';
    }
    
}

?>