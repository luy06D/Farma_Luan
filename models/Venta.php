<?php
require_once 'Conexion.php';

class Ventas extends Conexion{
    private $connection;

    public function __CONSTRUCT(){
        $this->connection = parent::getConnect();
    }

    
    public function lista_usuario(){
        try{ $query = $this->connection->prepare("CALL listarUsuario()");
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
    
        }catch(Exception $err){
            die($err->getMessage());
        }
    } 


    public function  registrar_venta($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->connection->prepare("CALL RegistrarVenta(?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["nomusuario"],
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operacion Codigo error: " .$e->getCode();
        }
        return $respuesta;
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

    public function productos_listar_categoria($categoria) {
        try {
            $query = $this->connection->prepare("CALL spu_productos_categoria(?)");
            $query->execute(array($categoria));
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $err) {
            die($err->getMessage());
        }
    }


    public function lista_productos(){
        try{ $query = $this->connection->prepare("CALL ListarLiderDetalleVenta()");
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
    
        }catch(Exception $err){
            die($err->getMessage());
        }
    } 

    public function productos_listar_id($idproducto){
        $respuesta = [
            "status" => false,
            "message" => "",
            "data" => []
        ];
    
        try{
            $consulta = $this->connection->prepare("CALL spu_listar_productoid(?)");
            $consulta->bindParam(1, $idproducto, PDO::PARAM_INT);
            $respuesta["status"] = $consulta->execute();
    
            // Obtener los resultados de la consulta
            $respuesta["data"] = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operación. Código de error: " .$e->getCode();
        }
    
        return $respuesta;
    }


    
    
    public function agregar_producto ($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->connection->prepare("CALL agregarProductoALaLista(?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["idproducto"],
                $datos["cantidad"],
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operacion Codigo error: " .$e->getCode();
        }
        return $respuesta;
    }


    public function eliminar_producto ($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->connection->prepare("CALL eliminarProducto(?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["iddetalleventa"],
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operacion Codigo error: " .$e->getCode();
        }
        return $respuesta;
    }

}