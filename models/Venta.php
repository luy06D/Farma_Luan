<?php
require_once 'Conexion.php';

class Ventas extends Conexion{
    private $connection;

    public function __CONSTRUCT(){
        $this->connection = parent::getConnect();
    }

    public function productos_listar_ventas($filtro){
        try{ $query = $this->connection->prepare("CALL spu_productos_listar_ventas(?)");
            $query->execute(array($filtro));
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
    
        }catch(Exception $err){
            die($err->getMessage());
        }
    }

}