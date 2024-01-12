<?php
    
session_start();

$_SESSION["status"] = [];

    require_once '../models/login.php';


    if(isset($_GET['operacion'])){

        $usuario = new Usuario();

        if($_GET['operacion'] == 'destroy'){
            session_destroy();
            session_unset();
            header('Location:../index.php');
        }

    
        if($_GET['operacion'] == 'login'){
            $acceso = [
                "status" => false,
                "nivelacceso" => "",
                "mensaje" => ""
            ];

            $data = $usuario->login($_POST['nomusuario']);
            $claveOriginal = $_POST['claveacceso'];

            if($data){
                if(password_verify($claveOriginal, $data['claveacceso'])){
                    $acceso["status"] = true;
                    $acceso["nivelacceso"] = $data["nivelacceso"];
                }else{
                    $acceso["mensaje"] = "Error en la contraseña";
                }
            }else{
                $acceso["mensaje"] = "No se encontro el usuario";
            }

            $_SESSION['seguridad'] = $acceso;

            echo json_encode($acceso);
        }
    }

    
?>