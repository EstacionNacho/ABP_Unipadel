<?php

require_once(__DIR__ . "/../model/Campeonato.php");
require_once(__DIR__ . "/../model/CampeonatoMapper.php");
require_once(__DIR__ . "/../model/Categoria.php");
require_once(__DIR__ . "/../model/CategoriaMapper.php");


require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class CampeonatoController extends BaseController {

    private $campeonatoMapper;
    private $categoriaMapper;

    public function __construct() {
        parent::__construct();

        $this->campeonatoMapper = new CampeonatoMapper();
        $this->categoriaMapper = new CategoriaMapper();
    }

    public function index() {
        if (!isset($this->currentUser)) {
            $this->view->render("usuarios", "login");
        } else {
            //if($this->currentUser->getTipo()!='admin'){
            //$errors = array();
            //$errors["general"] = "Usuario no valido para crear campeonatos";
            //$this->view->setVariable("errors", $errors);
            //$this->view->redirect("home", "index");
            //}
            $campeonatos = $this->campeonatoMapper->findAll();
            $this->view->setVariable("campeonatos", $campeonatos, false);
            $this->view->render("campeonato", "index");
        }
    }
    
    private function creacionCategoria($tipoCategoria, $idCampeonato, $nivel) {
            
            $categoria = new Categoria();

            $categoria->setTipo($tipoCategoria);
            $categoria->setNivel($nivel);
            
            try {
                
                $categoria->checkIsValidForCreate();
                $idCategoria = $this->categoriaMapper->save($categoria);
                
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }

            //$campeonatocategoria->setIdCampeonato($idCampeonato);
            //$campeonatocategoria->setIdCategoria($idCategoria);
            //$this->campeonatocategoriaMapper->save($campeonatocategoria);
        }

    public function add() {
        
        $campeonato = new Campeonato();

        if (isset($_POST["nombreCampeonato"])) {

            $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
            $campeonato->setFechaInicio($_POST["fechaInicio"]);
            $campeonato->setFechaFin($_POST["fechaFin"]);
            $campeonato->setInicioInscripcion($_POST["inicioInscripcion"]);
            $campeonato->setFinInscripcion($_POST["finInscripcion"]);
            $campeonato->setReglas($_POST["reglas"]);

            try {

                $campeonato->checkIsValidForCreate();
                $idcam = $this->campeonatoMapper->save($campeonato);

                if (isset($_POST["masculina"])) {

                    $tipoCategoria = $_POST["masculina"];

                    if (isset($_POST["nivelMAS1"])) {

                        $nivel = $_POST["nivelMAS1"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMAS2"])) {

                        $nivel = $_POST["nivelMAS2"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMAS3"])) {

                        $nivel = $_POST["nivelMAS3"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                }
                if (isset($_POST["femenina"])) {
                    $tipoCategoria = $_POST["femenina"];
                    creacionCategoria($idcam, $tipoCategoria);
                }
                if (isset($_POST["mixta"])) {
                    $tipoCategoria = $_POST["mixta"];
                    creacionCategoria($idcam, $tipoCategoria);
                }
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->render("campeonato", "index");

        //Codigo funcionando comentado
        /*
          if (isset($_POST["nombreCampeonato"])) {

          try {
          if (isset($_POST["masculina"])) {

          $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
          $campeonato->setFechaInicio($_POST["fechaInicio"]);
          $campeonato->setFechaFin($_POST["fechaFin"]);
          $campeonato->setInicioInscripcion($_POST["inicioInscripcion"]);
          $campeonato->setFinInscripcion($_POST["finInscripcion"]);
          $campeonato->setReglas($_POST["reglas"]);
          $categoria->setTipo($_POST["masculina"]);
          $categoria->setNivel($_POST["nivel"]);

          try {

          $campeonato->checkIsValidForCreate();

          $idcam = $this->campeonatoMapper->save($campeonato);
          $idcat = $this->categoriaMapper->save($categoria);
          } catch (ValidationException $ex) {
          $errors = $ex->getErrors();
          $this->view->setVariable("errors", $errors);
          }
          }

          if (isset($_POST["femenina"])) {

          $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
          $campeonato->setFechaInicio($_POST["fechaInicio"]);
          $campeonato->setFechaFin($_POST["fechaFin"]);
          $campeonato->setInicioInscripcion($_POST["inicioInscripcion"]);
          $campeonato->setFinInscripcion($_POST["finInscripcion"]);
          $campeonato->setReglas($_POST["reglas"]);
          $categoria->setTipo($_POST["femenina"]);
          $categoria->setNivel($_POST["nivel"]);

          try {

          $campeonato->checkIsValidForCreate();

          $this->campeonatoMapper->save($campeonato);
          $this->categoriaMapper->save($categoria);
          } catch (ValidationException $ex) {
          $errors = $ex->getErrors();
          $this->view->setVariable("errors", $errors);
          }
          }

          if (isset($_POST["mixta"])) {

          $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
          $campeonato->setFechaInicio($_POST["fechaInicio"]);
          $campeonato->setFechaFin($_POST["fechaFin"]);
          $campeonato->setInicioInscripcion($_POST["inicioInscripcion"]);
          $campeonato->setFinInscripcion($_POST["finInscripcion"]);
          $campeonato->setReglas($_POST["reglas"]);
          $categoria->setTipo($_POST["mixta"]);
          $categoria->setNivel($_POST["nivel"]);

          try {

          $campeonato->checkIsValidForCreate();

          $this->campeonatoMapper->save($campeonato);
          $this->categoriaMapper->save($categoria);

          } catch (ValidationException $ex) {
          $errors = $ex->getErrors();
          $this->view->setVariable("errors", $errors);
          }
          }

          $this->view->setFlash(sprintf("Campeonato \"%s\" añadido correctamente."), $campeonato->getNombreCampeonato());
          $this->view->redirect("campeonato", "index");

          } catch (ValidationException $ex) {

          $errors = $ex->getErrors();
          $this->view->setVariable("errors", $errors);
          }
          }
          $this->view->render("campeonato", "index");
         */
    }

    public function view() {

        $nombreCampeonato = $_REQUEST["nombreCampeonato"];

        if ($nombreCampeonato == NULL) {
            throw new Exception("No se han realizado campeonatos");
        }

        $campeonatos = $this->campeonatoMapper->finAll();

        $this->view->setVariable("campeonatos", $campeonatos, false);

        $this->view->render("campeonato", "index");
    }

}
