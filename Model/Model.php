<?php

class Model {
          
    public function conectar(){
                
        $con = mysqli_connect("localhost","root","");
        if(!$con){
            die('<div class="div_msg" >Erro no servidor, verifique seus dados</div>');
        }
        if (!mysqli_select_db($con,"vistasoft")) {
            die('<div class="div_msg" >Erro ao conectar-se ao banco de dados, verifique o nome do banco de dados</div>');
        }
        return $con;  
    }
          
    public function listarTarefas($selecao){
        
        /* define dia atual */
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d');
        $horario = date('H:i');
        
        switch($selecao)   {
    
            case "futuras":
                
                $consulta = "SELECT * FROM tarefas WHERE data > '" . $date . "' ORDER BY data ASC, horario ASC"; 
                          
            break;

            case "antigas":
                
                $consulta = "SELECT * FROM tarefas WHERE (data = '" . $date . "' AND  horario <= '" . $horario . "') OR data < '" . $date . "' ORDER BY data ASC, horario ASC"; 
                        
            break;  
                
            case "hoje":
                
                $consulta = "SELECT * FROM tarefas WHERE data = '" . $date . "' AND  horario >= '" . $horario . "' ORDER BY data ASC, horario ASC"; 
  
            break;  

            default: 
                
                $consulta = "SELECT * FROM tarefas ORDER BY data ASC, horario ASC"; 
            
            break;
                
        }
            

        // conectando base dados e retornar a query
        $model = new Model();
        $conexao = $model->conectar();	
        $sql = mysqli_query($conexao, $consulta);
        
        return $sql;
        
        
        
    }
    
    public function excluirDados($id) {
        
				        
        // faz conexão com banco de dados
        $model = new Model();
        $con=$model->conectar();

       
        // insera as informacoes
        $sql = "DELETE FROM tarefas WHERE id = " . $id;
        
        // verifica se houve erro
        if (!mysqli_query($con,$sql))
        {
            die('<div class="div_msg" >Error: ' . mysqli_error($con) .'</div>');
        }

        // finaliza a conexão
        mysqli_close($con);
        
    }
  
    public function selecionarDados($id) {
        
        // conectando base dados e retornar a query
        $model = new Model();
        $conexao = $model->conectar();	
        $consulta = "SELECT * FROM tarefas WHERE id = " . $id; 
        $sql = mysqli_query($conexao, $consulta);
        
        return $sql;
				
    }
  
    public function editarDados($id,$data,$horario,$nome) {
        
        // conectando base dados e retornar a query
        $model = new Model();
        $conexao = $model->conectar();	
        $consulta = "SELECT * FROM tarefas ORDER BY data ASC, horario ASC"; 
        $sql = mysqli_query($conexao, $consulta);
        
        return $sql;
				
    }
    
    public function alterarDados($id, $data,$horario,$nome) {
        
        // faz conexão com banco de dados
        $model = new Model();
        $con=$model->conectar();
        
        // insera as informacoes
        $sql="UPDATE tarefas SET data='$data', horario='$horario', nome='$nome' WHERE id='$id'";
        
        // verifica se houve erro
        if (!mysqli_query($con,$sql))
        {
            die('<div class="div_msg" >Error: ' . mysqli_error($con) . '</div>');
        }

        // finaliza a conexão
        mysqli_close($con);

        
    }
    
    public function adicionarDados($data,$horario,$nome) {
        
        // faz conexão com banco de dados
        $model = new Model();
        $con=$model->conectar();

       
        // insera as informacoes
        $sql="INSERT INTO tarefas (data, horario, nome) VALUES ('$data','$horario','$nome')";


        // verifica se houve erro
        if (!mysqli_query($con,$sql))
        {
            die('<div class="div_msg" >Error: ' . mysqli_error($con) . '</div>');
        }

        // finaliza a conexão
        mysqli_close($con);

        
    }
    
}


?>