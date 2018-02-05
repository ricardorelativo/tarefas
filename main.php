    <!-- define o padrão de acentuação do sistema -->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    
    <!-- link do style que define laytou do sistema -->
    <link rel="stylesheet" href="CSS/style.css">
    
    <!-- link da biblioteca jQuery -->
    <script src="Script/jquery.js"></script>
    
    <!-- link do conteúdo  JavaScript do sistema -->
    <script src="Script/script.js"></script>

<?php
        /* faz a conexão dos arquivos do MVC */
        include 'Model/Model.php';
        include 'View/View.php';
        include 'Controller/Controller.php';

		/* verifica se operação existe */ 
        if(isset($_GET['operacao'])){
    
            /* paga valor da operação da URL */ 
            $operacao = $_GET['operacao'];
            
            /* consulta as operações do Controller */
            $controller = new Controller();
            $controller->navegacao($operacao); 
            
        } else {
            
            /* caso não exista a operação, exibe a view home */  
            $pagina_inicial = 'home';
            
            $view = new View();
            $view->titulo(' - Bem Vindos'); 
            $view->botoes($pagina_inicial); 
            $view->pagina($pagina_inicial); 
        
		}
		
?>