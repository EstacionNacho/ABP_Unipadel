
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");

$campeonato = $view->getVariable("campeonato");
$categorias = $view->getVariable("categorias");

$campeonatos = $view->getVariable("campeonatos");
$categoria = $view->getVariable("categoria");
$grupos = $view->getVariable("grupos");
$numParticipantes = $view->getVariable("numParticipantes");

$view->setVariable("title", "Inscribirse Campeonato");
?>

<html lang="es">
    <body>

        <div class="container">
            <div class="row">
                <h5><?php echo $campeonato["nombre"]; ?></h5>
            </div>
            <div class="row">
                <div class="col"><h5>Fecha inicio <?php echo $campeonato["fechaInicio"]; ?></h5></div>
                <div class="col"><h5>Fecha Fin <?php echo $campeonato["fechaFin"]; ?></h5></div>
            </div>
            <div class="row">
                <div class="col"><h5>Fecha inicio inscripciones <?php echo $campeonato["inicioInscripcion"]; ?></h5></div>
                <div class="col"><h5>Fecha fin inscripciones <?php echo $campeonato["finInscripcion"]; ?></h5></div>
            </div>
            <br>
        </div>
        <br>
        <?php if ($categorias != NULL) { ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nivel</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Max. Participantes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($categorias as $categoria):
                            ?>
                            <tr>
                                <td><?= $categoria["nivel"]; ?> </td>
                                <td><?= $categoria["tipo"]; ?> </td>
                                <td><?= $categoria["maxParticipantes"]; ?></td>
                            </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-auto">
                        <h3>Inscribirse Campeonato</h3>
                        <form name="crearcampeonato" action="index.php?controller=Campeonato&amp;action=inscribirse" method="POST">
                            <label>Usuario capitan</label>
                            <input type="text" name="nombreCapitan" value="" required/><br>
                            <label>Usuario compañero </label>
                            <input type="text" name="nombreDeportista" value="" required/><br>
                            <label>Nivel</label><br>
                            <input type="radio" name="nivel" value="1" required> 1<br>
                            <input type="radio" name="nivel" value="2" required> 2<br>
                            <input type="radio" name="nivel" value="3" required> 3<br>
                            <label>Tipo</label><br>
                            <input type="radio" name="tipo" value="Masculina" required> Masculino<br>
                            <input type="radio" name="tipo" value="Femenina" required> Femenino<br>
                            <input type="radio" name="tipo" value="Mixto" required> Mixto<br>
                            <input type="hidden" value="<?php echo $campeonato["idCampeonato"] ?>" name="idCampeonato" />
                            <input type="submit" name="submit" value="Inscribirse">
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
        <footer>
            <p>ABP_23</p>
        </footer>

    </body>
</html>

