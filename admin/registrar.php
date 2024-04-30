<?php
session_start();
include('conexion.php');
$mensaje = "";
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
<form action="registrar.php" method="post">
<div class="container mt-5">
        <h2>Registro de Usuario</h2>
        <form>
            <div class="mb-3">
                <label for="username" class="form-label">Nombre y Apellido</label>
                <input type="text" name="nom_ape" class="form-control" id="username" placeholder="Ingrese nombre y apellido" value=<?php echo isset($_POST['nom_ape']) ? $_POST['nom_ape']  : ' '; ?> >
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="user-name" class="form-control" id="username" placeholder="Nombre de Usuario"  autocomplete="off" value=<?php echo isset($_POST['user-name']) ? $_POST['user-name']  : ' '; ?>>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="contra-1" placeholder="Ingrese contraseña">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="confirm_password"  name="contra-2" placeholder="Repite la contraseña">
            </div>
            <button type="submit" class="btn btn-primary" name='registrar'>Registrarse</button>
            <?php echo $mensaje?>
        </form>
    </div>

</body>
</html>