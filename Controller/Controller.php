<?php

class Controller {
    
    /* função para criar os botões de navegação */
    public function botoes($tipo) {
        
        /* personalizando o msg sistema  */
        switch($tipo)   {
    
            case "tarefa":
                    $msg = ' - Listar';
            break;
            case "nova":
                    $msg = ' - Nova';
            break;
            default: 

                    $msg = ' - Home';

            break;
        }
        
        /* exibe lista dos botões */
        echo '
         <div class="div-table">
            <div class="div-table-row">
                <div class="div-table-cell"><h3>Lista de Tarefas'. $msg .'</h3>
                </div>
            </div>
        </div>
                <div id="bt_Geral" >Página Inicial</div>
                <div id="bt_Listar" >Listar Tarefas</div>
                <div id="bt_Adicionar" >Adicionar Tarefa</div>
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
	
	}
	
    public function editar($id,$data,$horario,$nome) {
   
    }
    
    public function excluir($id) {

    }
    
}

?>