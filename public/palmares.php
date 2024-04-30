<div class="palmares" id="palmares">
    <div class="palmares-title-container">
        <h1>Palmares</h1>
    </div>
    <div class="contenedor-palmares">
    <div class="slider-palmares">
            <div class="contenedor-palmares-equipos slide">
                <?php
                $equipos = "Barcelona";
                $sqlpalmares = "SELECT p.*, e.nombre_equipo
                                FROM palmares p
                                JOIN equipos e ON p.id_equipos = e.id_equipos
                                WHERE e.nombre_equipo = '$equipos'";
                $resultado = mysqli_query($con, $sqlpalmares);

                if(mysqli_num_rows($resultado) > 0) {
                    $row = mysqli_fetch_assoc($resultado);
                    $nombre_equipo = $row['nombre_equipo'];
                    ?>
                    <h2><?php echo $nombre_equipo; ?></h2>
                    <div class="content-palmares">
                    <?php
                    mysqli_data_seek($resultado, 0);
                    while($row = mysqli_fetch_assoc($resultado)) {
                        ?>
                        <div class="palmares-titulo">
                            <h3><?php echo $row['titulo']; ?></h3>
                            <p><?php echo $row['cantidad']; ?></p>
                            <img src="../admin/<?php echo $row['img_titulo']; ?>" alt="Titulos">
                        </div>
                        <?php
                        }
                    } else {
                        echo "No se encontraron palmares.";
                    }
                ?>
                </div>
            </div> <!-- FIN DE contenedor-equipos-palmares -->
            <!-- PARIS -->
            <div class="contenedor-palmares-equipos slide">
            <div class="slide"></div>
                <?php
                $equipos = "Paris Saint Germain";
                $sqlpalmares = "SELECT p.*, e.nombre_equipo
                                FROM palmares p
                                JOIN equipos e ON p.id_equipos = e.id_equipos
                                WHERE e.nombre_equipo = '$equipos'";
                $resultado = mysqli_query($con, $sqlpalmares);

                if(mysqli_num_rows($resultado) > 0) {
                    $row = mysqli_fetch_assoc($resultado);
                    $nombre_equipo = $row['nombre_equipo'];
                    ?>
                    <h2><?php echo $nombre_equipo; ?></h2>
                    <div class="content-palmares">
                    <?php
                    mysqli_data_seek($resultado, 0);
                    while($row = mysqli_fetch_assoc($resultado)) {
                        ?>
                        <div class="palmares-titulo">
                            <h3><?php echo $row['titulo']; ?></h3>
                            <p><?php echo $row['cantidad']; ?></p>
                            <img src="../admin/<?php echo $row['img_titulo']; ?>" alt="Titulos">
                        </div>
                        <?php
                        }
                    } else {
                        echo "No se encontraron palmares.";
                    }
                    ?>
                    </div>
            </div> <!-- FIN DE contenedor-equipos-palmares -->
        <!-- INTER MIAMI -->
        <div class="contenedor-palmares-equipos slide">
                <?php
                $equipos = "Inter Miami";
                $sqlpalmares = "SELECT p.*, e.nombre_equipo
                                FROM palmares p
                                JOIN equipos e ON p.id_equipos = e.id_equipos
                                WHERE e.nombre_equipo = '$equipos'";
                $resultado = mysqli_query($con, $sqlpalmares);

                if(mysqli_num_rows($resultado) > 0) {
                    $row = mysqli_fetch_assoc($resultado);
                    $nombre_equipo = $row['nombre_equipo'];
                    ?>
                    <h2><?php echo $nombre_equipo; ?></h2>
                   <div class="content-palmares">
                   <?php
                    mysqli_data_seek($resultado, 0);
                    while($row = mysqli_fetch_assoc($resultado)) {
                        ?>
                        <div class="palmares-titulo">
                            <h3><?php echo $row['titulo']; ?></h3>
                            <p><?php echo $row['cantidad']; ?></p>
                            <img src="../admin/<?php echo $row['img_titulo']; ?>" alt="Titulos">
                         </div>
                        <?php
                        }
                    } else {
                        echo "No se encontraron palmares.";
                    }
                    ?>
                    </div>
            </div> <!-- FIN DE contenedor-equipos-palmares -->
            <!-- SELECCION ARGENTINA -->
            <div class="contenedor-palmares-equipos slide">
                <?php
                $equipos = "Selección Argentina";
                $sqlpalmares = "SELECT p.*, e.nombre_equipo
                                FROM palmares p
                                JOIN equipos e ON p.id_equipos = e.id_equipos
                                WHERE e.nombre_equipo = '$equipos'";
                $resultado = mysqli_query($con, $sqlpalmares);

                if(mysqli_num_rows($resultado) > 0) {
                    $row = mysqli_fetch_assoc($resultado);
                    $nombre_equipo = $row['nombre_equipo'];
                    ?>
                    <h2><?php echo $nombre_equipo; ?></h2>
                    <div class="content-palmares">
                    <?php
                    mysqli_data_seek($resultado, 0);
                    while($row = mysqli_fetch_assoc($resultado)) {
                        ?>
                        <div class="palmares-titulo">
                            <h3><?php echo $row['titulo']; ?></h3>
                            <p><?php echo $row['cantidad']; ?></p>
                            <img src="../admin/<?php echo $row['img_titulo']; ?>" alt="Titulos">
                        </div>
                        <?php
                        }
                    } else {
                        echo "No se encontraron palmares.";
                    }
                    ?>
                    </div>
            </div> <!-- FIN DE contenedor-equipos-palmares -->
    </div> <!-- FIN DE contenedor-palmares -->
    </div> <!-- FIN DE slider-palmares -->
        <div class="slider-controls">
        <button class="prev-slide">&#10094;</button>
        <button class="next-slide">&#10095;</button>
    </div> 
</div> <!-- FIN DE palmares -->
<script>
window.addEventListener("scroll", function() {
    var titleContainer = document.querySelector('.palmares-title-container');
    var triggerTop = titleContainer.getBoundingClientRect().top;
    var windowHeight = window.innerHeight;

    if (triggerTop < windowHeight * 0.8) {
        titleContainer.classList.add('visible');
    }
});
</script>
