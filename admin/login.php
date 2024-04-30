<?php
session_start();
include('conexion.php');
$mensaje = "";
$mensaje_login = "";
//Registro
if(isset($_POST['registrar'])){
    $nombre_apellido = $_POST['nom_ape'];
    $user_name = $_POST['user-name'];
    $contra1 = $_POST['contra-1'];
    $contra2 = $_POST['contra-2'];
    if(empty($nombre_apellido) || empty($user_name) || empty($contra1) || empty($contra2)){
        $mensaje = "Todos los campos son obligatorios.";
    }else{
        //contraseña sean iguales
        if($contra1 !== $contra2){
            $mensaje = "Las contraseña no coinciden.";
        }
        //duplicado username
        $sqlusername = "SELECT * FROM registro WHERE username = '$user_name'";
        $resultadouser = mysqli_query($con, $sqlusername);
        if(mysqli_num_rows($resultadouser) > 0){
            $mensaje = "El nombre de usuario no esta disponible.";
        }

        if(empty($mensaje)){
            $sqlregistro = "INSERT INTO registro VALUES(null, '$nombre_apellido', '$user_name','$contra1')";
            $guardar = mysqli_query($con, $sqlregistro);
            if($guardar){
                header('Location: index.php');
            }else{
                $mensaje = "ERROR!". mysqli_error($con);
            }
        }
    }
}

//Login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $contrasena = $_POST['contrasena'];

    $sqllogin = "SELECT * FROM registro WHERE username = '$username'";
    $resultadologin = mysqli_query($con, $sqllogin);
    $usuario = mysqli_fetch_assoc($resultadologin);
    if($usuario){
        if($usuario['contrasena'] === $contrasena){
            $_SESSION['registro'] = $usuario;
           header('Location:index.php');
        }else{
            $mensaje_login = "Contraseña Incorrecta.";
        }
    }else{
        $mensaje_login = "Nombre de usuario Incorrecto.";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form action="login.php" method="post" class="m-5">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" name="username" autocomplete="off" class="form-control" id="exampleInputEmail1" >
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="contrasena" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" name='login' class="btn btn-primary">Iniciar</button>
  <a href="registrar.php" class="btn btn-success">Registrar</a>
  <?php echo $mensaje_login?>
</body>
</html>