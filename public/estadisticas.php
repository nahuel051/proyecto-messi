<div class="estadisticas" id="estadisticas">
<div class="scroll-trigger">
        <h1>Equipos y Goles</h1>
    </div>
    <div class="contenedor-equipos">
    <?php
        require_once('../admin/conexion.php');
        $sqlequipos = "SELECT * FROM equipos";
        $resultadoequipos = mysqli_query($con, $sqlequipos);

        if(mysqli_num_rows($resultadoequipos) > 0){
            while($equipo = mysqli_fetch_assoc($resultadoequipos)){
        ?>
                <div class="equipos">
                    <h3><?php echo $equipo['nombre_equipo']?></h3>
                    <p><?php echo $equipo['descripcion'] ?></p>
                    <img src="../admin/<?php echo $equipo['img_equipos']; ?>" alt="Imagen del equipo">
                    <!-- Link goles Barcelona -->
                   <?php 
                    if($equipo['nombre_equipo'] === 'Barcelona'){
                    ?>
                    <a href="goles_barcelona.php">Ver Goles</a>
                    <!-- Link goles Paris -->
                    <?php }else if($equipo['nombre_equipo'] === 'Paris Saint Germain'){
                        ?>
                      <a href="goles_paris.php">Ver Goles</a>
                    <!-- Link goles Inter -->
                    <?php
                    }
                    else if($equipo['nombre_equipo'] === 'Inter Miami'){
                        ?>
                      <a href="goles_inter.php">Ver Goles</a>
                    <!-- Link goles Argentina -->
                       <?php
                    }  else if($equipo['nombre_equipo'] === 'Selección Argentina'){
                        ?>
                      <a href="goles_seleccion.php">Ver Goles</a>
                        <?php
                    }
                    ?>
                </div> <!-- FIN DE equipos -->
        <?php
            }
        }
        ?>
    </div> <!-- FIN DE contenedor-equipos -->
 </div> <!-- FIN DE estadisticas -->
 <script>
window.addEventListener("scroll", function() {
    var scrollTrigger = document.querySelector('.scroll-trigger');
    var triggerTop = scrollTrigger.getBoundingClientRect().top;
    var windowHeight = window.innerHeight;

    if (triggerTop < windowHeight * 0.8) {
        scrollTrigger.classList.add('visible');
    }
});
</script>
