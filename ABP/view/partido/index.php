<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$partidos = $view->getVariable("partidos");
$fecha = $view->getVariable("fecha");
$anterior = 0;
$view->setVariable("title", "Crear Partido");
?>

<html lang="es">
    <head><link rel="stylesheet" href="/css/crearPartidoStyle.css" type="text/css"></head>
    <body>
        <script>
            function compare() {

                var startDt = document.getElementById("inicio_ins").value;
                var endDt = document.getElementById("fin_ins").value;

                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {

                    alert("Cuidado, la fecha de finalizacion es anterior a la inicio");
                    document.getElementById('fin_ins').value = "";
                    return false;
                }
            }
        </script>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Promocionar Partido</h3>
                    <form name="crearpartido" action="index.php?controller=Partido&amp;action=add" method="POST">
                        <label>Fecha inicio inscripciones</label>
                        <input type="date" name="inicioInscripcion" value="" id="inicio_ins" required/><br>
                        <label>Fecha fin inscripciones</label>
                        <input type="date" name="finInscripcion" value="" id="fin_ins" onblur="compare();" required/><br><br>
                        <input type="submit" name="submit" value="Promocionar Partido">
                    </form>
                </div>
            </div>
        </div>
        <section>
            <table class="table" >
                <thead><tr><th>Etiquetas</th></tr></thead>
                <tbody><tr><td style="border:solid;background-color:green;color:black;">Disponible</td>
                        <td style="border:solid;background-color:red;color:black;">Ocupado</td></tr></tbody>
            </table>
        </section>
        <section>
            <table class="table" >
                <thead><tr><th>Escoge Fecha</th></tr></thead>
                <form  action="index.php?controller=gestionarReservas&amp;action=verPistasFechaPartido" method="POST">
                    <tbody><tr><td><input type="date"  name="fecha" id="fecha" >
                                <input type="submit" name="ver" value="Ver pistas"></td></tr></tbody></table>
            <table class="table" >
                <?php if ($fecha != NULL) {
                    foreach ($fecha as $pista) { ?>
        <?php if ($anterior != $pista->getHorarioIdPista()) { ?>
                            <thead><tr><th>Pista: <?= $pista->getHorarioIdPista(); ?></th></tr></thead>

                            <?php
                            $anterior = $pista->getHorarioIdPista();
                        }
                        ?>
                        <?php if ($pista->getDisponibilidad() == 'disponible') { ?>
                            <td><a style="border:solid;background-color:green;color:black;" href="index.php?controller=gestionarReservas&amp;action=comprobarReservaPartido&amp;fecha=<?php $pista->getFecha(); ?>&amp;pista=<?php $pista->getHorarioIdPista(); ?>&amp;hora=<?php $pista->getHora(); ?>&amp;disponibilidad=<?php $pista->getDisponibilidad(); ?>"><?php echo $pista->getHora(); ?></a></td>
                            <?php } else { ?>
                            <td><a style="border:solid;background-color:red;color:black;" href="index.php?controller=gestionarReservas&amp;action=comprobarReservaPartido&amp;fecha=<?php echo $pista->getFecha(); ?>&amp;pista=<?php $pista->getHorarioIdPista(); ?>&amp;hora=<?php $pista->getHora(); ?>&amp;disponibilidad=<?php $pista->getDisponibilidad(); ?>"><?php $pista->getHora(); ?></a></td>
        <?php } ?>
    <?php }
} ?>
                </form>
            </table>
        </section>
        <footer>
            <p>ABP_23</p>
        </footer>
    </body>
</html>
