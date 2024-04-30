<?php
include("conexion.php");
session_start();
if(!isset($_SESSION['registro'])){
    header('Location: login.php');
    exit();
}
$mensaje = "";

if(isset($_POST['subir'])){
    $partidos = $_POST['partidos'];
    $goles = $_POST['goles'];
    $asistencias = $_POST['asistencias'];
    
    if(empty($partidos)|| empty($goles)||empty($asistencias)){
        $mensaje = "Todos los campos son obligatorios.";
    }else{
        $sqlestadisticas = "INSERT INTO estadisticas (partidos, goles, asistencias) VALUES ('$partidos', '$goles', '$asistencias')";
        $guardar = mysqli_query($con, $sqlestadisticas);
        if($guardar){
            header("Location: estadisticas.php");
            exit();
        }else{
            $mensaje = "Error al guardar en la base de datos.";
        }
    }
}
?>

<?php include("cabecera.php")?>
<?php include("lateral.php")?>
<div class="container mt-5">

<form action="estadisticas.php" method="post">
        <div class="mb-3">
            <label for="partidos" class="form-label">Cantidad de Partidos</label>
            <input type="number" name="partidos" class="form-control" id="partidos" placeholder="Cantidad de Partidos">
        </div>
        <div class="mb-3">
            <label for="goles" class="form-label">Cantidad de Goles</label>
            <input type="number" name="goles" class="form-control" id="goles" placeholder="Cantidad de Goles">
        </div>
        <div class="mb-3">
            <label for="asistencias" class="form-label">Cantidad de Asistencias</label>
            <input type="number" name="asistencias" class="form-control" id="asistencias" placeholder="Cantidad de Asistencias">
        </div>
        <button type="submit" class="btn btn-primary" name="subir">Subir</button>
        <?php echo $mensaje ?> 
    </form>
<table class="table table-striped mt-3">
    <thead>
        <th>#</th>
        <th>Partidos</th>
        <th>Goles</th>
        <th>Asistencias</th>
        <th>Fecha de actualización</th>
        <th>Acciones</th>

    </thead>
    <tbody>
        <?php 
        $sqltabla = "SELECT * FROM `estadisticas`";
        $resultadoestadisticas = mysqli_query($con, $sqltabla);
        while($row = mysqli_fetch_array($resultadoestadisticas)){ ?>
        <tr>
            <td> <?php echo $row['id']?></td> 
            <td> <?php echo $row['partidos']?></td>  
            <td><?php echo $row['goles']?></td>
            <td><?php echo $row['asistencias']?></td>
            <td><?php echo $row['fecha']?></td>
            <td>
            <a href="edit_estadisticas.php?id=<?php echo $row['id']?>"class="btn btn-primary">Editar</a>
            </td>
        </tr>
        <?php 
        }
        ?>
    </tbody>
</table>
</div>
</body>
</html>