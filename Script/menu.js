    $(document).ready(function() {
            
        
            $("#bt_Geral").click(function(){
                $("#div_tarefas").load("index.php");
            });

            $("#bt_Adicionar").click(function(){
                $("#div_tarefas").load("index.php?operacao=Adicionar");
            });

            $("#bt_Listar").click(function(){
                $("#div_tarefas").load("index.php?operacao=Listar");
            });

            $(".bt_CancelarTarefa").click(function(){
                $("#div_tarefas").load("index.php?operacao=Listar");
            });

        
           
    });