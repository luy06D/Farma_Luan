<?php
    session_start();
    if (isset($_SESSION['segurity']['status']) && $_SESSION['segurity']['status']) {
        header('Location: ../administrador.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AHHHHHHHHHHHHHHHHHHHH</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="design">
            <div class="pill-1 rotate-45"></div>
            <div class="pill-2 rotate-45"></div>
            <div class="pill-3 rotate-45"></div>
            <div class="pill-4 rotate-45"></div>
        </div>
        <div class="login">
            <h3 class="title">Login</h3>
            <div class="text-input">
                <i class="ri-user-fill"></i>
                <input type="text" id="usuario" placeholder="Nombre Usuario">
            </div>
            <div class="text-input">
                <i class="ri-lock-fill"></i>
                <input type="password" id="clave" placeholder="Contraseña">
            </div>
            <button class="login-btn" id="iniciar-sesion">Iniciar Sesion</button>
            <!-- <a href="#" class="forgot">Forgot Username/Password?</a>
            <div class="create">
                <a href="#">Create Your Account</a>
                <i class="ri-arrow-right-fill"></i>
            </div> -->
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
                const nomusuario = document.querySelector("#usuario");
                const claveacceso = document.querySelector("#clave");
                const btlogin = document.querySelector("#iniciar-sesion");
    
                function inicioSesion(){
                    const parametros = new URLSearchParams();
                    parametros.append("operacion", "login");
                    parametros.append("nomusuario", nomusuario.value);
                    parametros.append("claveacceso", claveacceso.value);

                    fetch('./controllers/login.controllers.php', {
                        method: 'POST',
                        body: parametros
                    })
                    .then(respuesta => respuesta.json())
                    .then(datos => {
                        console.log(datos); // Imprime la respuesta en la consola para depurar

                        if(datos.status){
                            // Acceder a los datos almacenados en la sesión
                            const nombres = datos.nombres; // Asegúrate de que estos campos estén presentes en la respuesta
                            const apellidos = datos.apellidos;

                            alert(`Bienvenido: ${datos.nombres} ${datos.apellidos}`);
                            window.location.href = './views/administrador.php';
                        }
                    })
                }
            btlogin.addEventListener("click", inicioSesion);
        })

    </script>
</body>
</html>