    $(document).ready(function() {
            
        
            $("#bt_Geral").click(function(){
                $("#div_tarefas").load("main.php");
            });

            $("#bt_Adicionar").click(function(){
                $("#div_tarefas").load("main.php?operacao=Adicionar");
            });

            $("#bt_Listar").click(function(){
                $("#div_tarefas").load("main.php?operacao=Listar");
            });

            $(".bt_CancelarTarefa").click(function(){
                $("#div_tarefas").load("main.php?operacao=Listar");
            });

            
            $(".bt_SalvaTarefa").click(function(){

                
                /* pegar valores do formulário com JS e criptografar as informações*/
                 var editarid = window.btoa($("input[name=editarid]").val());
                 var editardata = window.btoa($("input[name=editardata]").val());
                 var editarhorario = window.btoa($("input[name=editarhorario]").val());
                 var editarnome = window.btoa($("input[name=editarnome]").val());
           
                
                /* criptografar informações novamente com BASE64 */
                var enc = window.btoa('#@'+editarid+'#@'+editardata+'#@'+editarhorario+'#@'+editarnome+'#@');
             
            /* envia dados pela URL para que possa ser pego pelo GET editar*/
            $("#div_tarefas").load('main.php?operacao=Listar&acao=editar&mudanca='+enc);
                
                
            });
    
    
    			/* função para processar o cadastro do nova tarefa */
            $(".bt_NovaTarefa").click(function(){
    
                /* pegar valores do formulário com JS  e criptografar as informações*/
                 var novadata = window.btoa($("input[name=novadata]").val());
                 var novohorario = window.btoa($("input[name=novohorario]").val());
				 /* criptografar campo nome */
                 var novonome = window.btoa($("input[name=novonome]").val());
           
                
                /* criptografar informações com BASE64 */
                var enc = window.btoa('#@'+novadata+'#@'+novohorario+'#@'+novonome+'#@');
             
            /* envia dados pela URL para que possa ser pego posteriormente pelo GET incluir*/
            $("#div_tarefas").load('main.php?operacao=Adicionar&acao=nova&incluir='+enc);
                                   
                
                
            });
        
           
    });


    /* função para pegar ID que deseja editar */
    function alterar(id){
               
            $(document).ready(function() {
                $("#div_tarefas").load("main.php?operacao=Listar&acao=editar&id=" + id);  
            });
               
    }

    /* função para pegar ID que deseja excluir */
    function apagar(id){
               
            $(document).ready(function() {
                $("#div_tarefas").load("main.php?operacao=Listar&acao=excluir&id=" + id);  
            });
               
    }

    /* formatar entrada do campo input */
    function formatar(src, mask)
    {
    var i = src.value.length;
    var saida = mask.substring(0,1);
    var texto = mask.substring(i)
    if (texto.substring(0,1) != saida)
    {
    src.value += texto.substring(0,1);
    }
    }

    /* Valida Data */
    var reDate4 = /^((0?[1-9]|[12]\d)\/(0?[1-9]|1[0-2])|30\/(0?[13-9]|1[0-2])|31\/(0?[13578]|1[02]))\/(19|20)?\d{2}$/;
    var reDate = reDate4;

    function doDate(Id, pStr, pFmt){
    d = document.getElementById(Id);
    if (d.value != ""){
    if (d.value.length < 10){
    alert("Data Inválida!\nDigite corretamente a data: dd/mm/aaaa !");
    d.value="";
    d.focus();
    return false;
    }else{

    eval("reDate = reDate" + pFmt);
    if (reDate.test(pStr)) {
    return false;
    } else if (pStr != null && pStr != "") {
    alert("Erro de Preenchimento!\n\n" + pStr + " NÃO é uma data válida.");
    d.value="";
    d.focus();
    return false;
    }
    }
    }else{
    return false;
    }
    }

    /* Valida Horário */
    function doHorario(Id,Valor){
    d = document.getElementById(Id);
        if (d.value != ""){
            if (d.value.length < 5){
                alert("Horário Inválido!\nDigite corretamente o horário 'HH:MM'!");
                d.value="";
                d.focus();
                return false;
            }else{
                hrs = (d.value.substring(0,2));
                min = (d.value.substring(3,5));

               if ($.isNumeric(hrs) && $.isNumeric(min)){

                   if ((hrs < 00 ) || (hrs > 23) || ( min < 00) ||( min > 59)){
                        alert("Erro de Preenchimento!\n\n" + Valor + " Não é um horário válido (00:00 ~ 23:59)");
                        d.value="";
                        d.focus();
                        return false;
                        } else {
                                return false;
                        }

                } else {
                        alert("Erro de Preenchimento!\n\n" + Valor + " Digite apenas numeros.");
                        d.value="";
                        d.focus();
                        return false;
                }

            }
        } else {
        return false;
        }
    }

    /* Valida Descrição */
    function doNome(Id,Valor){
    d = document.getElementById(Id);
        if (d.value != ""){
            if (d.value.length > 200){
                alert("Descrição muito longo!\n Digite descrição menor de 200 caracteres!");
                d.value="";
                d.focus();
                return false;
            }
        } else {
        return false;
        }
    }

