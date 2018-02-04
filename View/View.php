<?php

class View {
  
    /* função para exibir tela de abertura */
    public function home() {
        
        echo '
        <div class="div-table">
			<div class="div-table-row">
				<div class="div-table-cell">
                    
				<h3>Sistema está no momento em desenvolvimento</h3>
				</div>
			</div>
			<div class="div-table-row">
				<div class="div-table-cell">
				<p>Desenvolvido por <b>Ricardo Felisbino</b></p>
				</div>
			</div>
        </div>
		';
        
    }
    
	/* função para exibir opções do menu */
    public function opcao($tipo) {
	
       /* consulta as operações do Controller */
       $controller = new Controller();
       $controller->botoes($tipo); 
        
        
    }
    
    public function listar() {
        
		/* verifica se existe as variáveis e se a ação é de excluir */
    	if((isset($_GET['acao']))  && (isset($_GET['id'])) && ($_GET['acao']=='excluir')){
            
        $controller = new Controller();
		$controller->excluir($_GET['id']); 
               
		/* verifica se existe as variáveis e se a ação é de editar */
        } elseif ((isset($_GET['acao'])) && (isset($_GET['id'])) && ($_GET['acao']=='editar')){
            
        $controller = new Controller();
		$controller->editar($_GET['id']); 
        
		/* verifica se existe as variáveis e se a ação é de salvar */
        } elseif ((isset($_GET['acao'])) && (isset($_GET['mudanca'])) && ($_GET['acao']=='editar')){
            
            
        $controller = new Controller();
		$controller->salvar($_GET['mudanca']); 
        
		/* caso não tenha sido validado nenhum dos critérios acima */
        } else {
            
        $controller = new Controller();
		$controller->listar(); 
           
        }
		
	}
    
    
    public function adicionar() {
	    
		/* verifica existencia de ação */
        if((isset($_GET['acao'])) && ($_GET['acao']=='nova')){
       
        echo '
        <div class="div-table">
			<div class="div-table-row">
				<div class="div-table-cell">';
                
        /* pega variavel codificada */
        $dadosEnc = $_GET['incluir'];

        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->adicionarTarefa($dadosEnc); 
            
        echo '</div></div></div>';
            
        } else {
        
        /* exibe formulario para adicionar */
        $controller = new Controller();
		$controller->adicionar(); 
               	    
	
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
}

?>