<?php

class Model {
          
    public function conectar(){
                
        $con = mysqli_connect("localhost","root","");
        if(!$con){
            die("Erro no servidor, verifique seus dados");
        }
        if (!mysqli_select_db($con,"vistasoft")) {
            die("Erro ao conectar-se ao banco de dados, verifique o nome do banco de dados");
        }
        return $con;  
    }
          
    public function listarTarefas(){
        
        // conectando base dados e retornar a query
        $model = new Model();
        $conexao = $model->conectar();	
        $consulta = "SELECT * FROM tarefas ORDER BY data ASC, horario ASC"; 
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
            die('<BR>Error: ' . mysqli_error($con));
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
            die('<BR>Error: ' . mysqli_error($con));
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
            die('<BR>Error: ' . mysqli_error($con));
        }

        // finaliza a conexão
        mysqli_close($con);

        
    }
    
}


?>