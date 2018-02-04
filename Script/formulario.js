    /* função para pegar ID que deseja editar */
    function alterar(id){
               
            $(document).ready(function() {
                $("#div_tarefas").load("index.php?operacao=Listar&acao=editar&id=" + id);  
            });
               
    }

    /* função para pegar ID que deseja excluir */
    function apagar(id){
               
            $(document).ready(function() {
                $("#div_tarefas").load("index.php?operacao=Listar&acao=excluir&id=" + id);  
            });
               
    }

$(document).ready(function() {
    
			/* função para processar o cadastro do nova tarefa */
            $(".bt_NovaTarefa").click(function(){
    
                /* pegar valores do formulário com JS */
                 var novadata = $("input[name=novadata]").val();
                 var novohorario = $("input[name=novohorario]").val();
				 /* criptografar campo nome */
                 var novonome = window.btoa($("input[name=novonome]").val());
           
                
                /* criptografar informações com BASE64 */
                var enc = window.btoa('#@'+novadata+'#@'+novohorario+'#@'+novonome+'#@');
             
            /* envia dados pela URL para que possa ser pego posteriormente pelo GET incluir*/
            $("#div_tarefas").load('index.php?operacao=Adicionar&acao=nova&incluir='+enc);
                                   
                
                
            });
 });
