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
    
    public function excluirDados($id) {
        
				
    }
  
    public function editarDados($id,$data,$horario,$nome) {
        
				
    }
    
    public function adicionarDados($id,$data,$horario,$nome) {
        
				
    }
    
}

?>