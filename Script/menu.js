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

            $(".bt_NovaTarefa").click(function(){
                $("#div_tarefas").load("index.php?operacao=Adicionar&acao=nova");
            });
    
            $(".bt_SalvaTarefa").click(function(){
                $("#div_tarefas").load("index.php?operacao=Listar&acao=salvar");
            });

           
    });

    /* função para pegar ID que deseja editar */
    function alterar(id,data,horario,nome){
               
            $(document).ready(function() {
                $("#div_tarefas").load("index.php?operacao=Listar&acao=editar&id=" + id + "&data=" + data + "&horario=" + horario + "&nome=" + nome);  
            });
               
    }

    /* função para pegar ID que deseja excluir */
    function apagar(id){
               
            $(document).ready(function() {
                $("#div_tarefas").load("index.php?operacao=Listar&acao=excluir&id=" + id);  
            });
               
    }