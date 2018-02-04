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
        
    		
	}
    
    
    public function adicionar() {
	
    
	}
    
    
    public function salvar() {
		
		
	}
}

?>