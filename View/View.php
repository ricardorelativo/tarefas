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

            /* verifica se existe as variáveis e se a ação é de salvar */
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
            $controller->adicionarTarefa($dadosEnc); 


            } else {

            /* exibe formulario para adicionar */
            $controller = new Controller();
            $controller->botoes($tipo); 
            $controller->adicionar(); 
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
}

?>