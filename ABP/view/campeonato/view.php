<?php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$campeonato = $view->getVariable("campeonato");
$categoria = $view->getVariable("categoria");
$view->setVariable("title", "Campeonato");

?>

<div class="container">
    <div class="row">
        <h5><?php echo $campeonato["nombre"];?></h5>
    </div>
    <div class="row">
        <div class="col"><h5>Fecha inicio <?php echo $campeonato["fechaInicio"];?></h5></div>
        <div class="col"><h5>Fecha Fin <?php echo $campeonato["fechaFin"];?></h5></div>
    </div>
    <div class="row">
        <div class="col"><h5>Fecha inicio <?php echo $campeonato["inicioInscripcion"];?></h5></div>
        <div class="col"><h5>Fecha Fin <?php echo $campeonato["finInscripcion"];?></h5></div>
    </div>
    <div class="row">
        <h5>Max participantes <?php echo $categoria["maxParticipantes"];?></h5>
    </div>
</div>
