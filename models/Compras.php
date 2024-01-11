<?php
require_once 'Conexion.php';

class Compras extends Conexion{
    private $connection;

    public function __CONSTRUCT(){
        $this->connection = parent::getConnect();

    }


    
public function compras_registrar ($datos = []){
    $respuesta = [
        "status" => false,
        "message" => "",
        "idcompraproducto" => null
    ];
    
    try{
        $consulta = $this->connection->prepare("CALL spu_compra_registrar(?,?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
            
            $datos["idusuario"],
            $datos["tipocomprobante"],
            $datos["numlote"],
            $datos["numfactura"],           
        ));

        //Obtenemos el idcompraproducto que se genera
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        if($resultado){
            $respuesta["idcompraproducto"] = $resultado["idcompraproducto"];
        }
    }
    catch(Exception $e){
        $respuesta["message"] = "No se pudo completar la operacion Codigo error: " .$e->getCode();
    }
    return $respuesta;

}

    
public function detalleC_registrar ($datos = []){
    $respuesta = [
        "status" => false,
        "message" => ""
    ];
    try{
        $consulta = $this->connection->prepare("CALL spu_detalleC_registrar(?,?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
            
            $datos["idproducto"],
            $datos["idcompraproducto"],
            $datos["cantidad"],
            $datos["preciocompra"],           
        ));
    }
    catch(Exception $e){
        $respuesta["message"] = "No se pudo completar la operacion Codigo error: " .$e->getCode();
    }
    return $respuesta;
}

public function buscar_productos($buscar = ""){
    try{
        $query = $this->connection->prepare("CALL spu_producto_buscar(?)");
        $query->execute(array($buscar));
        return $query->fetchAll(PDO::FETCH_ASSOC);
        
    }
    catch(Exception $err){
        die($err->getMessage());
    }
}



}

?>