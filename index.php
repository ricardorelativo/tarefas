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
</head>
<body>
<?php
       
            $view = new View();
            $view->opcao('geral'); 
            $view->home(); 
        
?>
</body>
</html>