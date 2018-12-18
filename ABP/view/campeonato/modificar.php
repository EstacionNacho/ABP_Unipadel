
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$campeonato = $view->getVariable("campeonato");
$view->setVariable("title", "Crear Campeonato");
?>

<html lang="es">
    <body>
        <script>

            function compareB() {

                var startDt = document.getElementById("inicio_ins").value;
                var endDt = document.getElementById("fin_ins").value;

                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {

                    alert("Cuidado, la fecha de finalizacion es anterior a la inicio");
                    document.getElementById('fin_ins').value = "";
                    return false;
                }
            }
            function compareA() {

                var startDt = document.getElementById("inicio").value;
                var endDt = document.getElementById("fin").value;

                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {

                    alert("Cuidado, la fecha de finalizacion es anterior a la inicio");
                    document.getElementById('fin').value = "";
                    return false;
                }
            }

        </script>
        <div class="container">
            <div class="row">
                <div class="col-md-auto">
                    <h3>Modificar Campeonato</h3>
                    <form name="crearcampeonato" action="index.php?controller=Campeonato&amp;action=modificarCampeonato" method="POST">
                        <label>Nombre del campeonato</label>
                        <input type="text" name="nombreCampeonato" value="<?php echo $campeonato["nombre"] ?>" required/><br><br>
                        <label>Fecha inicio</label>
                        <input type="date" id="inicio" name="fechaInicio" value="<?php echo $campeonato["fechaInicio"] ?>" required/><br>
                        <label>Fecha finalización</label>
                        <input type="date" id="fin" name="fechaFin" value="<?php echo $campeonato["fechaFin"] ?>" onblur="compareA();" required/><br>
                        <label>Fecha inscripciones</label>
                        <input type="date" id ="inicio_ins" name="inicioInscripcion" value="<?php echo $campeonato["inicioInscripcion"] ?>" required/><br>
                        <label>Fecha fin inscripciones</label>
                        <input type="date" id="fin_ins" name="finInscripcion" value="<?php echo $campeonato["finInscripcion"] ?>"  onblur="compareB();" required/><br><br>                     
                        <label>Reglas</label><br>
                        <textarea name="reglas" rows="3" cols="40"><?php echo $campeonato["reglas"] ?></textarea><br><br>
                        <input type="hidden" value="<?php echo $campeonato["idCampeonato"] ?>" name="idCampeonato" />
                        <input type="submit" name="submit" value="Modificar campeonato">
                    </form>
                </div>
            </div>
        </div>
</div>

<footer>
    <p>ABP_23</p>
</footer>

</body>
</html>

