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
      
    }	
    
    public function listar() {
	
	}
	
    public function editar($id,$data,$horario,$nome) {
   
    }
    
    public function excluir($id) {

    }
    
}

?>