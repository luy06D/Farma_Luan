<?php
require_once "conexion.php";

class Usuario extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }

    public function login($nomUsuario = '') {
        try {
            $consulta = $this->conexion->prepare("SELECT * FROM usuarios WHERE nomusuario = ?");
            $consulta->execute(array($nomUsuario));
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
?>