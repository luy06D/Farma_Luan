<?php
require_once 'Conexion.php';

class Unidades extends Conexion{
    private $connection;

    public function __CONSTRUCT(){
        $this->connection = parent::getConnect();
    }

    
public function unidades_listar(){
    try{
        $query = $this->connection->prepare("SELECT * FROM unidades");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }catch(Exception $err){
        die($err->getMessage());
    }
}


}

?>