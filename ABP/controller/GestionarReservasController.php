<?php

//file: controller/EnfrentamientoController.php

require_once(__DIR__ . "/../model/Partido.php");
require_once(__DIR__ . "/../model/PartidoMapper.php");
require_once(__DIR__ . "/../model/PartidoReserva.php");
require_once(__DIR__ . "/../model/PartidoReservaMapper.php");
require_once(__DIR__ . "/../model/GestionarReservas.php");
require_once(__DIR__ . "/../model/GestionarReservasMapper.php");
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../controller/BaseController.php");

/**
 * @author Victor
 */
class GestionarReservasController extends BaseController {

    private $gestionarReservasMapper;
    private $partidoMapper;
    private $partidoReservaMapper;

    public function __construct() {
        parent::__construct();
        $this->GestionarReservasMapper = new GestionarReservasMapper();
        $this->partidoMapper = new PartidoMapper();
        $this->partidoReservaMapper = new PartidoReservaMapper();
    }

    public function index() {
        $this->view->render("reservas", "gestionarReservas");
    }

    public function verPistasFecha() {

        if (isset($_REQUEST['fecha'])) {
            $dia = $_REQUEST["fecha"];
            $fecha = $this->GestionarReservasMapper->findByFecha($dia);
            $this->view->setVariable("fecha", $fecha, false);
            $this->view->render("reservas", "gestionarReservas");
        }
    }

    public function verPistasFechaPartido() {

        if (isset($_REQUEST['fecha'])) {
            $dia = $_REQUEST["fecha"];
            $fecha = $this->GestionarReservasMapper->findByFecha($dia);
            $this->view->setVariable("fecha", $fecha, false);
            $this->view->render("partido", "index");
        }
    }

    public function comprobarReserva() {
        // populate the Post object with data form the form
        $pista = $_REQUEST["pista"];

        $hora = $_REQUEST["hora"];
        $fecha = $_REQUEST["fecha"];

        $disponibilidad = $_REQUEST["disponibilidad"];
        $minutosAumentar = 90;
        $segundos_horaInicio = strtotime($hora);
        $segundos_minutoAumentar = $minutosAumentar * 60;
        $horaFinal = date("H:i", $segundos_horaInicio + $segundos_minutoAumentar);
        $this->view->setVariable("pista", $pista, false);
        $this->view->setVariable("hora", $hora, false);
        $this->view->setVariable("fecha", $fecha, false);
        $this->view->setVariable("disponibilidad", $disponibilidad, false);
        $this->view->setVariable("horaFinal", $horaFinal, false);

        $this->view->render("reservas", "reserva");
    }

    public function comprobarReservaPartido() {

        $pista = $_REQUEST["pista"];
        $hora = $_REQUEST["hora"];
        $fecha = $_REQUEST["fecha"];
        $disponibilidad = $_REQUEST["disponibilidad"];
        $minutosAumentar = 90;
        $segundos_horaInicio = strtotime($hora);
        $segundos_minutoAumentar = $minutosAumentar * 60;
        $horaFinal = date("H:i", $segundos_horaInicio + $segundos_minutoAumentar);       
        
        $this->view->setVariable("pista", $pista, false);
        $this->view->setVariable("hora", $hora, false);
        $this->view->setVariable("fecha", $fecha, false);
        $this->view->setVariable("disponibilidad", $disponibilidad, false);
        $this->view->setVariable("horaFinal", $horaFinal, false);

        $this->view->render("partido", "reserva");
    }

}
