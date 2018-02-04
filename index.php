<?php
    /* faz a conexão com o MVC */
    include 'Model/Model.php';
    include 'View/View.php';
    include 'Controller/Controller.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="CSS/style.css">
    <script src="Script/jquery.js"></script>
    <script src="Script/menu.js"></script>
    <script src="Script/formulario.js"></script>
</head>
<body>
<div id="div_tarefas">
<center>
<?php
        
		/* verifica se operação existe */ 
        if(isset($_GET['operacao'])){
    
            /* paga valor da operação da URL */ 
            $operacao = $_GET['operacao'];
            
            /* consulta as operações do Controller */
            $controller = new Controller();
            $controller->navegacao($operacao); 
            
        } else {
            
            /* caso não exista a operação, exibe a view do menu */    
            $view = new View();
            $view->opcao('geral'); 
            $view->home(); 
        
		}
		
?>
</center>
</div>
</body>
</html>