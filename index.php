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
</head>
<body>
<div id="div_tarefas">
<?php
       
            $view = new View();
            $view->opcao('geral'); 
            $view->home(); 
        
?>
</div>
</body>
</html>